<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\lamaran;
use App\Models\lowongan;
use Illuminate\Http\Response;

class LamaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->level == 2){
    	   $lamaran = lamaran::all()->where('perusahaan_id', '=', Auth::user()->perusahaan->id);
           //dd($lamaran);
           return view('lamaran.index', ['lamaran' => $lamaran]);
        }
        else
        {
            $lamaran = lamaran::all();
            return view('lamaran.index', ['lamaran' => $lamaran]);
        }
    }

    public function create(lowongan $lowongan)
    {
    	return view('lamaran.create', compact('lowongan'));
    }

    public function store(Request $request, lowongan $lowongan)
    {
    	$message = [
            'required' => 'Belum ada file yang diupload!'
        ];

        if($request->lamaran == '' && $request->cv == '' && $request->ijazah == '')
        {
            return redirect()->back()->with(['error' => 'Belum ada File yang diupload!']);
    	}

        else if($request->cv == '' && $request->ijazah == '')
        {
            $lamaran = $request->lamaran->getClientOriginalExtension();
            if($lamaran == 'pdf')
            {
                $file_lamaran = Auth::user()->alumni->nama.'_'.$lowongan->perusahaan->nama.'_'.$lowongan->nama.'_lamaran.'.$lamaran;

                $data = [
                    'alumni_id' => Auth::user()->alumni->id,
                    'lowongan_id' => $lowongan->id,
                    'perusahaan_id' => $lowongan->perusahaan->id,
                    'lamaran' => $file_lamaran,
                    'cv' => '-',
                    'ijazah' => '-'
                ];

                $request->lamaran->move(public_path().'/template/dist/file', $file_lamaran);
                $t_lamaran = lamaran::create($data);
                DB::update('update lowongan set tersedia = tersedia - 1 where id = '.$lowongan->id);
                return redirect()->action(
                [LowonganController::class, 'index'])->with('success', 'Lamaran Berhasil Diupload!');
            }
            return redirect()->back()->with(['error' => 'File yang diupload harus berformat PDF!']);
        }

        else if($request->ijazah == '')
        {
            $lamaran = $request->lamaran->getClientOriginalExtension();
            $cv = $request->cv->getClientOriginalExtension();

            if($lamaran == 'pdf' && $cv =='pdf'){
                $file_lamaran = Auth::user()->alumni->nama.'_'.$lowongan->perusahaan->nama.'_'.$lowongan->nama.'_lamaran.'.$lamaran;
                $file_cv = Auth::user()->alumni->nama.'_'.$lowongan->perusahaan->nama.'_'.$lowongan->nama.'_cv.'.$cv;

                $data = [
                    'alumni_id' => Auth::user()->alumni->id,
                    'lowongan_id' => $lowongan->id,
                    'perusahaan_id' => $lowongan->perusahaan->id,
                    'lamaran' => $file_lamaran,
                    'cv' => $file_cv,
                    'ijazah' => '-'
                    ];

                $request->lamaran->move(public_path().'/template/dist/file', $file_lamaran);
                $request->cv->move(public_path().'/template/dist/file', $file_cv);
                $t_lamaran = lamaran::create($data);

                DB::update('update lowongan set tersedia = tersedia - 1 where id = '.$lowongan->id);
                return redirect()->action(
                [LowonganController::class, 'index'])->with('success', 'Lamaran Berhasil Diupload!');
            }
            return redirect()->back()->with(['error' => 'File yang diupload harus berformat PDF!']);
        }

        else if($request->cv == '')
        {
            $lamaran = $request->lamaran->getClientOriginalExtension();
            $ijazah = $request->ijazah->getClientOriginalExtension();

            if($lamaran == 'pdf' && $ijazah =='pdf'){
                $file_lamaran = Auth::user()->alumni->nama.'_'.$lowongan->perusahaan->nama.'_'.$lowongan->nama.'_lamaran.'.$lamaran;
                $file_ijazah = Auth::user()->alumni->nama.'_'.$lowongan->perusahaan->nama.'_'.$lowongan->nama.'_ijazah.'.$ijazah;

                $data = [
                    'alumni_id' => Auth::user()->alumni->id,
                    'lowongan_id' => $lowongan->id,
                    'perusahaan_id' => $lowongan->perusahaan->id,
                    'lamaran' => $file_lamaran,
                    'cv' => '-',
                    'ijazah' => $file_ijazah
                    ];

                $request->lamaran->move(public_path().'/template/dist/file', $file_lamaran);
                $request->ijazah->move(public_path().'/template/dist/file', $file_ijazah);
                $t_lamaran = lamaran::create($data);

                DB::update('update lowongan set tersedia = tersedia - 1 where id = '.$lowongan->id);
                return redirect()->action(
                [LowonganController::class, 'index'])->with('success', 'Lamaran Berhasil Diupload!');
            }
            return redirect()->back()->with(['error' => 'File yang diupload harus berformat PDF!']);
        }

        else
        {
            $lamaran = $request->lamaran->getClientOriginalExtension();
            $cv = $request->cv->getClientOriginalExtension();
            $ijazah = $request->ijazah->getClientOriginalExtension();

            if($lamaran == 'pdf' && $cv =='pdf' && $ijazah == 'pdf'){
                $file_lamaran = Auth::user()->alumni->nama.'_'.$lowongan->perusahaan->nama.'_'.$lowongan->nama.'_lamaran.'.$lamaran;
                $file_cv = Auth::user()->alumni->nama.'_'.$lowongan->perusahaan->nama.'_'.$lowongan->nama.'_cv.'.$cv;
                $file_ijazah = Auth::user()->alumni->nama.'_'.$lowongan->perusahaan->nama.'_'.$lowongan->nama.'_ijazah.'.$ijazah;

                $data = [
                    'alumni_id' => Auth::user()->alumni->id,
                    'lowongan_id' => $lowongan->id,
                    'perusahaan_id' => $lowongan->perusahaan->id,
                    'lamaran' => $file_lamaran,
                    'cv' => $file_cv,
                    'ijazah' => $file_ijazah
                    ];

                $request->lamaran->move(public_path().'/template/dist/file', $file_lamaran);
                $t_lamaran = lamaran::create($data);

                DB::update('update lowongan set tersedia = tersedia - 1 where id = '.$lowongan->id);
                return redirect()->action(
                [LowonganController::class, 'index'])->with('success', 'Lamaran Berhasil Diupload!');
            }
            return redirect()->back()->with(['error' => 'File yang diupload harus berformat PDF!']);
        }
    }
}
