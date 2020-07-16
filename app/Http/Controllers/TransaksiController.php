<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Acara;
use App\Anggota;
use App\Transaksi;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {      
        $transaksi = Transaksi::get();
        $anggota   = Anggota::get();
        $acara      = Acara::get();
        
        if(Auth::user()->level == 'user')
        {
            $datas = Transaksi::where('anggota_id', Auth::user()->anggota->id)
                                ->get();
        } else {
            $datas = Transaksi::get();
        }
        // return view('transaksi.index', compact('datas'));
        return view('transaksi.index', compact('transaksi', 'anggota', 'acara', 'datas'));
        
        // if(Auth::user()->level == 'user')
        // {
        //     $datas = Transaksi::where('status', 'belum')
        //                         ->where('anggota_id', Auth::user()->anggota->id)
        //                         ->get();
        // } else {
        //     $datas = Transaksi::where('status', 'belum')->get();
        // }
        // return view('home', compact('transaksi', 'anggota', 'acara', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "UKDW00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "UKDW0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "UKDW000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "UKDW00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "UKDW0".''.($lastId->id + 1);
            } else {
                    $kode = "UKDW".''.($lastId->id + 1);
            }
        }

        $acaras = Acara::where('jumlah_acara', '>', 0)->get();
        $anggotas = Anggota::get();
        return view('transaksi.create', compact('acaras', 'kode', 'anggotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_transaksi' => 'required|string|max:255',
            'tgl_transaksi' => 'required',
            'jml_donasi' => 'required',
            'bank' => 'required',
            'rek' => 'required',
            'total_donasi' => 'required',
            'ket' => 'required',
            'acara_id' => 'required',
            'anggota_id' => 'required',

        ]);

        $transaksi = Transaksi::create([
                'kode_transaksi' => $request->get('kode_transaksi'),
                'tgl_transaksi' => $request->get('tgl_transaksi'),
                'jml_donasi' => $request->get('jml_donasi'),
                'bank' => $request->get('bank'),
                'rek' => $request->get('rek'),
                'total_donasi' => $request->get('total_donasi'),
                'ket' => $request->get('ket'),
                'acara_id' => $request->get('acara_id'),
                'anggota_id' => $request->get('anggota_id'),
                'status' => 'belum'
            ]);

        $transaksi->acara->where('id', $transaksi->acara_id)
                        ->update([
                            'jumlah_acara' => ($transaksi->acara->jumlah_acara - 1),
                            ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');
        return redirect()->route('transaksi.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Transaksi::findOrFail($id);


        if((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }


        return view('transaksi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data = Transaksi::findOrFail($id);

        if((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        return view('acara.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        $transaksi->update([
                'status' => 'lunas'
                ]);

        $transaksi->acara->where('id', $transaksi->acara->id)
                        ->update([
                            'jumlah_acara' => ($transaksi->acara->jumlah_acara + 1),
                            ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('transaksi.index');
    }
}
