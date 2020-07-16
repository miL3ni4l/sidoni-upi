<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Acara;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use RealRashid\SweetAlert\Facades\Alert;

class AcaraController extends Controller
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
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }
         $acara = Acara::get();
        $datas = Acara::get();
        return view('acara.index', compact('datas', 'acara'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        return view('acara.create');
    }

    public function format()
    {
        $data = [['nama_acr' => null, 'tgl_acara' => null, 'lokasi' => null, 'jumlah_acara' => null, 'ket' => null]];
            $fileName = 'format-acara';
            

        $export = Excel::create($fileName.date('Y-m-d_H-i-s'), function($excel) use($data){
            $excel->sheet('acara', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        });

        return $export->download('xlsx');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'importAcara' => 'required'
        ]);

        if ($request->hasFile('importAcara')) {
            $path = $request->file('importAcara')->getRealPath();

            $data = Excel::load($path, function($reader){})->get();
            $a = collect($data);

            if (!empty($a) && $a->count()) {
                foreach ($a as $key => $value) {
                    $insert[] = [
                            'nama_acr' => $value->nama_acr, 
                            'tgl_acara' => $value->tgl_acara, 
                            'lokasi' => $value->lokasi,  
                            'jumlah_acara' => $value->jumlah_acara, 
                            'ket' => $value->ket, 
                            'cover' => NULL];

                    Acara::create($insert[$key]);
                        
                    }
                  
            };
        }
        alert()->success('Berhasil.','Data telah diimport!');
        return back();
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
            'nama_acr' => 'required|string|max:255',
            // 'isbn' => 'required|string'
        ]);

        if($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/Acara", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        Acara::create([
                
                'nama_acr' => $request->get('nama_acr'),
                'tgl_acara' => $request->get('tgl_acara'),
                'pengarang' => $request->get('pengarang'),
                'lokasi' => $request->get('lokasi'),
                'jumlah_acara' => $request->get('jumlah_acara'),
                'ket' => $request->get('ket'),
                'cover' => $cover
            ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');

        return redirect()->route('acara.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->level == 'user') {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        $data = Acara::findOrFail($id);

        return view('acara.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if(Auth::user()->level == 'user') {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        $data = Acara::findOrFail($id);
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
        if($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/acara", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        Acara::find($id)->update([
                'nama_acr' => $request->get('nama_acr'),
                'tgl_acara' => $request->get('tgl_acara'),
                'pengarang' => $request->get('pengarang'),
                'lokasi' => $request->get('lokasi'),
                'jumlah_acara' => $request->get('jumlah_acara'),
                'ket' => $request->get('ket'),
                'cover' => $cover
                ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('acara.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Acara::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('acara.index');
    }
}
