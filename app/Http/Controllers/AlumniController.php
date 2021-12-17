<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\alumni;
use Validator;
use Hash;
use Session;
use App\Models\User;

class AlumniController extends Controller
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
        $alumni = alumni::all();
        return view('alumni.index', ['alumni' => $alumni]);
    }

    public function data()
    {
        $alumni = DB::select('select * from alumnis except select * from alumnis where user_id = '.Auth::user()->id);
        return view('alumni.data', ['alumni' => $alumni]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumni.create');
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
            'size' => ' :attribute harus :size karakter!',
            'unique' => ' Data sudah terdaftar, gunakan data lain.'
        ];

        $request->validate([
            'nis' => 'required|size:4|unique:alumnis,nis',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'jurusan' => 'required',
            'lulusan' => 'required',
            'email' => 'unique:users,email'
        ], $message);

        if($request->email==null){
            $request->email = "alumni{$request->nis}@gmail.com";
        }

        $user = new User;
        $user->username = "alumni{$request->nis}";
        $user->email = strtolower($request->email);
        $user->password = Hash::make("smkti{$request->lulusan}");
        $user->level = "1";
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->save();
        //alumni::create($request->all());
        $file = $request->gambar;
        $data = [
                'user_id' => $user->id,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'jurusan' => $request->jurusan,
                'lulusan' => $request->lulusan,
                'status' => "",
                'pesan' => ""
            ];
        $data['gambar'] = "default.png";
            if($file)
            {
                $gambar = $file->getClientOriginalName();
                $data['gambar'] = $gambar;
                $file->move(public_path().'/template/dist/img/alumni', $gambar);
            }
        alumni::create($data);
        return redirect('/alumni')->with('status', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $alumni)
    {
        return view('alumni.show', compact('alumni'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(alumni $alumni)
    {
        return view('alumni.edit', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, alumni $alumni)
    {
        $message = [
            'required' => ' :attribute wajib diisi!',
            'size' => ' :attribute harus :size karakter!',
            'unique' => ' Data sudah terdaftar, gunakan data lain.'
        ];

        $request->validate([
            'nis' => 'required|size:4',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'jurusan' => 'required',
            'lulusan' => 'required',
            'email' => 'unique:users,email'
        ], $message);

        $file = $request->gambar;
        $data = [
                'nis' => $request->nis,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tanggal_lahir' => \Carbon\Carbon::parse($request->tanggal_lahir)->format('Y/m/d'),
                'agama' => $request->agama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'jurusan' => $request->jurusan,
                'lulusan' => $request->lulusan
            ];
            if($file)
            {
                $gambar = $file->getClientOriginalName();
                $data['gambar'] = $gambar;
                $file->move(public_path().'/template/dist/img/alumni', $gambar);
            }
            alumni::where('id', $alumni->id)->update($data);
        return redirect('/alumni')->with('status', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(alumni $alumni)
    {
        alumni::destroy($alumni->id);
        User::destroy($alumni->user_id);
        return redirect('/alumni')->with('status', 'Data Berhasil Dihapus');
    }
}
