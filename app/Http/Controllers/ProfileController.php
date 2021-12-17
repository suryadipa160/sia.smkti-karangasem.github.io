<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\alumni;
use App\Models\User;
use App\Models\perusahaan;
use App\Models\lamaran;
use Hash;

class ProfileController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function profile(User $profile)
    {
        if(Auth::user()->level=="1")
        {
            $lamaran = lamaran::all()->where('alumni_id', '=', Auth::user()->alumni->id);
            return view('profile.profile', ['lamaran' => $lamaran], compact('profile'));
        }
        return view('profile.profile', compact('profile'));
    }

    public function edit_perusahaan(perusahaan $profile)
    {
        return view('profile.perusahaan', compact('profile'));
    }

    public function edit_alumni(alumni $profile)
    {
        return view('profile.alumni', compact('profile'));
    }

    public function akun(User $profile)
    {
        return view('profile.akun', compact('profile'));
    }

    public function update_perusahaan(Request $request, perusahaan $profile)
    {
        $file = $request->gambar;
        $data = [
            'nama' => $request->nama,
            'tentang' => $request->tentang,
            'alamat' => $request->alamat,
            'website' => $request->website,
            'no_telp' => $request->no_telp
        ];
        if($file)
        {
            $gambar = $file->getClientOriginalName();
            $data['gambar'] = $gambar;
            $file->move(public_path().'/template/dist/img/perusahaan', $gambar);
        }
        perusahaan::where('id', $profile->id)->update($data);
        return redirect()->action(
        	[ProfileController::class, 'profile'], ['profile' => $profile->user_id]
        )->with('status', 'Data Berhasil Diubah!');
    }

    public function update_alumni(Request $request, alumni $profile)
    {
        $file = $request->gambar;
        $data = [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'jenis_kelamin' => $request->jenis_kelamin
            ];
            if($file)
            {
                $gambar = $file->getClientOriginalName();
                $data['gambar'] = $gambar;
                $file->move(public_path().'/template/dist/img/alumni', $gambar);
            }
            alumni::where('id', $profile->id)->update($data);
        return redirect()->action(
        	[ProfileController::class, 'profile'], ['profile' => $profile->user_id]
        )->with('status', 'Data Berhasil Diubah!');
    }

    public function update_akun(Request $request, User $profile)
    {
        $message = [
            'required' => ' :attribute wajib diisi!',
            'confirmed' => ' :attribute harus sama!',
            'unique' => ' Data sudah terdaftar, gunakan data lain.'
        ];

        $request->validate([
            'email' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ], $message);

        $data = [
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ];

        User::where('id', $profile->id)->update($data);
        
        if(Auth::user()->level=="1"){
            return redirect()->action(
            [ProfileController::class, 'profile'], ['profile' => $profile->id]
        )->with('status', 'Data Berhasil Diubah!');
        }
        if(Auth::user()->level=="2"){
            return redirect()->action(
            [ProfileController::class, 'profile'], ['profile' => $profile->id]
        )->with('status', 'Data Berhasil Diubah!');
        }
        else{
            return redirect()->action(
            [HomeController::class, 'index'])->with('status', 'Data Berhasil Diubah!');
        }
    }
}
