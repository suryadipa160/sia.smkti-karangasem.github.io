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
use PDF;

class CetakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lowongan()
    {
        $jenis = 'Lowongan';
        return view('cetak.index', ['jenis' => $jenis])->with('message', 'Sistem akan menampilkan data perusahaan dan lowongan yang diupload.');
    }

    public function lamaran()
    {
        $jenis = 'Lamaran';
        return view('cetak.index', ['jenis' => $jenis])->with('message', 'Sistem akan menampilkan data alumni yang mengajukan lamaran pekerjaan.');
    }

    public function alumni()
    {
        return view('cetak.alumni')->with('message', 'Sistem akan menampilkan data alumni berdasarkan tahun lulusan.');
    }

    public function perusahaan()
    {
        $perusahaan = perusahaan::all();
        $total = perusahaan::all()->count();
        $pdf = PDF::loadview('cetak.perusahaan',[
            'perusahaan' => $perusahaan,
            'total' => $total
        ])->setPaper('a4','landscape');

        return $pdf->stream();
    }

	public function cetak(Request $request)
    {
        if($request->jenis == 'Lowongan'){

            $tanggal_awal = $request->tanggal_awal;
            $tanggal_akhir = \Carbon\Carbon::parse($request->tanggal_akhir)->addDays(1);

            $lowongan = DB::select(
                'select perusahaans.nama as "perusahaan", kategori.nama as "kategori", lowongan.nama, lowongan.created_at as "upload" from perusahaans, lowongan, kategori where lowongan.kategori_id=kategori.id and perusahaans.id=lowongan.perusahaan_id and lowongan.created_at BETWEEN "'.$tanggal_awal.'" and "'.$tanggal_akhir.'" order by perusahaan');

            $total = DB::select('select count(lowongan.nama) as "total" from perusahaans, lowongan, kategori where lowongan.kategori_id=kategori.id and perusahaans.id=lowongan.perusahaan_id and lowongan.created_at BETWEEN "'.$tanggal_awal.'" and "'.$tanggal_akhir.'"');

            $pdf = PDF::loadview('cetak.lowongan',[
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' => $tanggal_akhir,
                'lowongan' => $lowongan,
                'total' => $total
            ])->setPaper('a4','landscape');

            return $pdf->stream();

            //dd($total);
        }

        if($request->jenis == 'Lamaran') {

            $tanggal_awal = $request->tanggal_awal;
            $tanggal_akhir = \Carbon\Carbon::parse($request->tanggal_akhir)->addDays(1);

            $lamaran = DB::select(
                'select alumnis.nama as "alumni", alumnis.lulusan as "lulusan", perusahaans.nama as "perusahaan", lowongan.nama as "lowongan", lamaran.created_at as "upload" from alumnis, perusahaans, lowongan, lamaran where lamaran.alumni_id=alumnis.id and perusahaans.id=lowongan.perusahaan_id and lowongan.id=lamaran.lowongan_id and lamaran.created_at BETWEEN "'.$tanggal_awal.'" and "'.$tanggal_akhir.'" order by alumni');

            $alumni = DB::select('select alumnis.nama as "alumni", alumnis.lulusan as "lulusan", alumnis.jurusan as "jurusan" from alumnis, lamaran where alumnis.id=lamaran.alumni_id and lamaran.created_at between "'.$tanggal_awal.'" and "'.$tanggal_akhir.'" group by alumni, lulusan, jurusan');

            $t_alumni = lamaran::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->groupBy('alumni_id')->count();

            $lowongan = DB::select('select lowongan.nama as "lowongan", perusahaans.nama as "perusahaan" from lowongan, lamaran, perusahaans where lowongan.id=lamaran.lowongan_id and perusahaans.id=lamaran.perusahaan_id and lamaran.created_at between "'.$tanggal_awal.'" and "'.$tanggal_akhir.'" GROUP by lowongan, perusahaan');

            $t_lowongan = lamaran::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->groupBy('lowongan_id')->count();

            $pdf = PDF::loadview('cetak.lamaran',[
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' => $tanggal_akhir,
                'lamaran' => $lamaran,
                'alumni' => $alumni,
                't_alumni' => $t_alumni,
                'lowongan' => $lowongan,
                't_lowongan' => $t_lowongan
            ])->setPaper('a4','landscape');

            return $pdf->stream();
            //dd($t_alumni);
        }
        else{
            if($request->lulusan == 1){
                $alumni = DB::select('select * from alumnis order by nis');
            }
            else{
                $alumni = DB::select('select * from alumnis where lulusan = "'.$request->lulusan.'"');
            }
            
            $total = alumni::all()->count();
            $pdf = PDF::loadview('cetak.cetak',[
                'alumni' => $alumni,
                'total' => $total
            ])->setPaper('a4','landscape');

            return $pdf->stream();
        }
    	// $alumni = alumni::all()->count();
     //    $perusahaan = perusahaan::all()->count();
     //    $lowongan = lowongan::all()->count();
     //    $kategori = kategori::all()->count();
     //    $lamaran = lamaran::all()->count();
     //    $tanggal_awal = $request->tanggal_awal;
     //    $tanggal_akhir = $request->tanggal_akhir;

     //    $j_alumni = lamaran::whereBetween('created_at',[$tanggal_awal, $tanggal_akhir])->count();
     //    $j_perusahaan = perusahaan::whereBetween('created_at',[$tanggal_awal, $tanggal_akhir])->count();
     //    $j_lowongan = lowongan::whereBetween('tanggal_dibuat',[$tanggal_awal, $tanggal_akhir])->count();

     //    // $d_lowongan = DB::select('select * from perusahaans, lowongan, lamaran where perusahaans.id=lowongan.perusahaan_id and lowongan.id=lamaran.lowongan_id and lowongan.tanggal_dibuat BETWEEN "'.$tanggal_awal.'" and "'.$tanggal_akhir.'"');

     //    $d_lowongan = DB::select('select perusahaans.nama as "perusahaan", lowongan.nama, lowongan.created_at as "upload" from perusahaans, lowongan where perusahaans.id=lowongan.perusahaan_id and lowongan.created_at BETWEEN "'.$tanggal_awal.'" and "'.$tanggal_akhir.'" GROUP BY perusahaans.nama, lowongan.nama, lowongan.created_at');

     //    $d_alumni = DB::select('select alumnis.nis, alumnis.nama, alumnis.angkatan FROM alumnis, lamaran WHERE alumnis.id=lamaran.alumni_id and lamaran.created_at BETWEEN "'.$tanggal_awal.'" and "'.$tanggal_akhir.'" GROUP BY alumnis.nama, alumnis.nis, alumnis.angkatan');

     //    $d_perusahaan = perusahaan::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();

     //    $pdf = PDF::loadview('cetak.cetak',[
     //    	'alumni' => $alumni,
     //    	'perusahaan' => $perusahaan,
     //    	'lowongan' => $lowongan,
     //    	'kategori' => $kategori,
     //    	'lamaran' => $lamaran,
     //    	'tanggal_awal' => $tanggal_awal,
     //    	'tanggal_akhir' => $tanggal_akhir,
     //    	'j_alumni' => $j_alumni,
     //    	'j_perusahaan' => $j_perusahaan,
     //    	'j_lowongan' => $j_lowongan,
     //        'd_lowongan' => $d_lowongan,
     //        'd_alumni' => $d_alumni,
     //        'd_perusahaan' => $d_perusahaan
     //    ]);
     //    return $pdf->stream();

        //dd($d_perusahaan);
    }    
}
