<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\perusahaan;
use App\Models\kategori;
use App\Models\lowongan;
use App\Models\lamaran;

class LowonganController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        Paginator::useBootstrap();
    	$lowongan = lowongan::orderBy('tanggal_dibuat','desc')->paginate(2);
    	$kategori = kategori::all();
    	$perusahaan = perusahaan::all();
    	return view('lowongan.index', ['lowongan' => $lowongan, 'kategori' => $kategori, 'perusahaan' => $perusahaan]);
    }

    public function cari_kategori(kategori $kategori)
    {
    	$lowongan = lowongan::where('kategori_id','=', $kategori->id)->orderBy('tanggal_dibuat','desc')->paginate(2);
    	$kategori = kategori::all();
    	$perusahaan = perusahaan::all();
    	return view('lowongan.index', ['lowongan' => $lowongan, 'kategori' => $kategori, 'perusahaan' => $perusahaan]);
    }

    public function cari_perusahaan(perusahaan $perusahaan)
    {
        $lowongan = lowongan::where('perusahaan_id','=', $perusahaan->id)->orderBy('tanggal_dibuat','desc')->paginate(2);
        $kategori = kategori::all();
        $perusahaan = perusahaan::all();
        return view('lowongan.index', ['lowongan' => $lowongan, 'kategori' => $kategori, 'perusahaan' => $perusahaan]);
    }

    public function hasil_perusahaan(perusahaan $perusahaan)
    {
        return redirect()->action(
            [LowonganController::class, 'cari_perusahaan'], ['perusahaan' => $perusahaan->id]
        )->with('status', 'Perusahaan : '.$perusahaan->nama);
    }

    public function hasil_kategori(kategori $kategori)
    {
        return redirect()->action(
            [LowonganController::class, 'cari_kategori'], ['kategori' => $kategori->id]
        )->with('status', 'Kategori : '.$kategori->nama);
    }

    public function info(lowongan $lowongan)
    {
        if(Auth::user()->level=="1")
        {
            $lamaran = DB::select('select * from alumnis, lamaran, lowongan where alumnis.id=lamaran.alumni_id and lowongan.id=lamaran.lowongan_id and lamaran.alumni_id='.Auth::user()->alumni->id.' and lamaran.lowongan_id='.$lowongan->id);
            return view('lowongan.info', ['lamaran' => $lamaran], compact('lowongan'));
            
        }
    	return view('lowongan.info', compact('lowongan'));
    }
    
    public function tampil()
    {
    	$kategori = kategori::all();
        return view('lowongan.addlowongan', ['kategori' => $kategori]);
    }

    public function lihat(perusahaan $perusahaan)
    {
    	$lowongan = lowongan::all()->where('perusahaan_id', $perusahaan->id);
        return view('lowongan.showlowongan', ['lowongan' => $lowongan]);
    }

    public function tambah(Request $request, perusahaan $perusahaan)
    {
    	$message = [
            'required' => ' :attribute wajib diisi!'
        ];

        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'persyaratan' => 'required',
            'tanggal_akhir' => 'required',
            'tersedia' => 'required'
        ], $message);

        lowongan::create([
            'perusahaan_id' => $perusahaan->id,
            'nama' => $request->nama,
            'kategori_id' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'tanggal_dibuat' => date('Y/m/d'),
            'tanggal_akhir' => $request->tanggal_akhir,
            'tersedia' => $request->tersedia
        ]);

        return redirect()->action(
        	[LowonganController::class, 'lihat'], ['perusahaan' => $perusahaan->id]
        )->with('status', 'Data Berhasil Ditambahkan');
    }

    public function detail(lowongan $lowongan)
    {
        $jml_lamaran = DB::select('select count(id) from lamaran where perusahaan_id='.$lowongan->id);
    	return view('lowongan.detail', ['jml_lamaran' => $jml_lamaran], compact('lowongan'));
    }

    public function edit(lowongan $lowongan)
    {
    	$kategori = kategori::all();
    	return view('lowongan.edit', ['kategori' => $kategori], compact('lowongan'));
    }

    public function update(Request $request, lowongan $lowongan)
    {
    	lowongan::where('id', $lowongan->id)
            ->update([
                'nama' => $request->nama,
                'kategori_id' => $request->kategori,
                'deskripsi' => $request->deskripsi,
                'persyaratan' => $request->persyaratan,
                'tanggal_akhir' => $request->tanggal_akhir,
                'tersedia' => $request->tersedia
            ]);
        return redirect()->action(
        	[LowonganController::class, 'detail'], ['lowongan' => $lowongan->id]
        )->with('status', 'Data Berhasil Diubah!');
    }

    public function destroy(lowongan $lowongan)
    {
        if(Auth::user()->level=="0")
        {
            lowongan::destroy($lowongan->id);
                return redirect()->action(
                    [LowonganController::class, 'index'])->with('success', 'Data Berhasil Hapus!');
        }
        else{
                lowongan::destroy($lowongan->id);
        return redirect()->action(
            [LowonganController::class, 'lihat'], ['perusahaan' => Auth::user()->perusahaan->id]
        )->with('status', 'Data Berhasil Hapus!');
        }
    }
}
