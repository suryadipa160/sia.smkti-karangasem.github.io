<?php

namespace App\Http\Controllers;

use App\Models\perusahaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Carbon\Carbon;

class PerusahaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perusahaan = perusahaan::all();
        return view('perusahaan.index', ['perusahaan' => $perusahaan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ' :attribute wajib diisi!',
            'confirmed' => ' :attribute harus sama!',
            'unique' => ' Data sudah terdaftar, gunakan data lain'
        ];

        $request->validate([
            'nama' => 'required',
            'tentang' => '',
            'alamat' => 'required',
            'website' => '',
            'no_telp' => 'required',
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ], $message);
        if($request->website==""){
            $request->website = "-";
        }if($request->tentang==""){
            $request->tentang = "-";
        }
        $user = new User;
        $user->username = $request->username;
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->level = "2";
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->save();
        $file = $request->gambar;
        $data = [
            'user_id' => $user->id,
            'nama' => $request->nama,
            'tentang' => $request->tentang,
            'alamat' => $request->alamat,
            'website' => $request->website,
            'no_telp' => $request->no_telp
        ];
        
        $data['gambar'] = "default.jpg";
        if($file)
        {
            $gambar = $file->getClientOriginalName();
            $data['gambar'] = $gambar;
            $file->move(public_path().'/template/dist/img/perusahaan', $gambar);
        }
        perusahaan::create($data);
        return redirect('/perusahaan')->with('status', 'Data Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(User $perusahaan)
    {
        return view('perusahaan.show', compact('perusahaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit(perusahaan $perusahaan)
    {
        $email = DB::table('users')->where('id', $perusahaan->user_id)->value('email');
        return view('perusahaan.edit', ['email' => $email]  , compact('perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, perusahaan $perusahaan)
    {
        $message = [
            'required' => ' :attribute wajib diisi!',
            'confirmed' => ' :attribute harus sama!',
            'unique' => ' Data sudah terdaftar, gunakan data lain'
        ];

        $request->validate([
            'nama' => 'required',
            'tentang' => '',
            'alamat' => 'required',
            'website' => '',
            'no_telp' => 'required',
            'email' => 'required'
        ], $message);

        $file = $request->gambar;
        $data = [
            'nama' => $request->nama,
            'tentang' => $request->tentang,
            'alamat' => $request->alamat,
            'website' => $request->website,
            'no_telp' => $request->no_telp
        ];
        $data_user=[
            'email' => $request->email
        ];
        if($file)
        {
            $gambar = $file->getClientOriginalName();
            $data['gambar'] = $gambar;
            $file->move(public_path().'/template/dist/img/perusahaan', $gambar);
        }
        $id = DB::table('perusahaans')->where('id', $perusahaan->id)->value('user_id');
        User::where('id', $id)->update($data_user);
        perusahaan::where('id', $perusahaan->id)->update($data);
        return redirect('/perusahaan')->with('status', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(perusahaan $perusahaan)
    {
        perusahaan::destroy($perusahaan->id);
        User::destroy($perusahaan->user_id);
        return redirect('/perusahaan')->with('status', 'Data Berhasil Dihapus');
    }
}
