<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Anggota;
use App\Acara;
use App\User;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $transaksi = Transaksi::get();
        // $anggota   = Anggota::get();
        // $acara      = Acara::get();
        
        // if(Auth::user()->level == 'user')
        // {
        //     $datas = Transaksi::where('status', 'belum')
        //                         ->where('anggota_id', Auth::user()->anggota->id)
        //                         ->get();
        // } else {
        //     $datas = Transaksi::where('status', 'belum')->get();
        // }
        // return view('home', compact('transaksi', 'anggota', 'acara', 'datas'));
        
        
        // Tambahan DASHBOARD
        $grafik = DB::table('transaksi')
                  ->select(DB::raw("DATE_FORMAT(tgl_transaksi,'%M') as period, SUM(total_donasi) as SiteA"))
                  ->orderBy('tgl_transaksi','ASC')->groupBy('period')->get();
   
        $anggotas = Anggota::count();
        $acaras = Acara::count();
        $transaksis = Transaksi::sum('total_donasi');
        $transaksi = Transaksi::get();
        $user = User::get();

        if(Auth::user()->level == 'user')
        {
            $datas = Transaksi::where('status', 'belum')
                                ->where('anggota_id', Auth::user()->anggota->id)
                                ->get();
        } else {
            $datas = Transaksi::where('status', 'belum')->get();
        }
        return view('layouts.dashboard',array('anggotas' => $anggotas, 'transaksi' => $transaksi, 'acaras' => $acaras, 'transaksis' => $transaksis, 'user' => $user, 'grafik' => $grafik, 'datas' => $datas));
    }
}
