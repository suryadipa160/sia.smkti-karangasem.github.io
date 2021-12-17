<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\alumni;
use App\Models\perusahaan;
use App\Models\lowongan;
use App\Models\kategori;
use App\Models\lamaran;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->level=="2"){
            $lowongan = lowongan::all()->where('perusahaan_id', '=', Auth::user()->perusahaan->id)->count();
            $lamaran = lamaran::all()->where('perusahaan_id', '=', Auth::user()->perusahaan->id)->count();

        return view('index', ['lowongan' => $lowongan, 'lamaran' => $lamaran]);
        };
        
        $alumni = alumni::all()->count();
        $perusahaan = perusahaan::all()->count();
        $lowongan = lowongan::all()->count();
        $kategori = kategori::all()->count();
        
        return view('index', ['alumni' => $alumni, 'perusahaan' => $perusahaan, 'lowongan' => $lowongan, 'kategori' => $kategori]);
    }

    public function upload(Request $request, alumni $alumni)
    {
        if($request->status==null){
            $request->status = "-";
        }
        if($request->pesan==null){
            $request->pesan = "-";
        }
        $data = [
                'status' => $request->status,
                'pesan' => $request->pesan
        ];
        alumni::where('id', $alumni->id)->update($data);
        return redirect('/index')->with('success', 'Berhasil dikirim.');
    }
}
