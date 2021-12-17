<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use Hash;
use Session;
use App\Models\User;
use App\Models\alumni;
use App\Models\perusahaan;
use DB;
use Carbon\Carbon;
use Mail;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return view('index');
        }
        return view('login');
    }
  
    public function login(Request $request)
    {
        $rules = [
            'username'              => 'required|username',
            'password'              => 'required|string'
        ];
  
        $messages = [
            'username.required'     => 'Username wajib diisi',
            'username.username'     => 'Username tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $data = [
            'username'  => $request->input('username'),
            'password'  => $request->input('password'),
        ];
  
        Auth::attempt($data);
  
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            //return redirect()->route('home');
            return redirect('/index');
  
        } else { // false
  
            //Login Fail
            Session::flash('error', 'Username atau password salah');
            return redirect()->route('login');
        }
  
    }
  
    public function showFormRegister()
    {
        return view('register');
    }
  
    public function register(Request $request)
    {
        $message = [
            'required' => ' :attribute wajib diisi!',
            'confirmed' => ' :attribute harus sama!',
            'unique' => 'Data sudah terdaftar, gunakan data lain.'
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
            $request->website = "-";
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
        return redirect()->route('login')->with('status', 'Berhasil Register');
    }

    public function showFormEmail()
    {
        return view('password.email');
    }

    public function password(Request $request)
    {
        $user = User::whereEmail($request->email)->first();

        if($user == null){
            return redirect()->back()->with(['error' => 'Email tidak terdaftar!']);
        }

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]);

        Mail::send('password.forgot', ['token' => $token], function($message) use ($request){
                $message->from('smktikarangasem@gmail.com');
                $message->to($request->email);
                $message->subject('Notifikasi Reset Password!');
        });

        return redirect()->back()->with(['success' => 'Reset Code sudah terkirim ke email anda!']);
    }

    public function showFormReset()
    {
        return view('password.reset');
    }
    
    public function confirm(Request $request)
    {
        $message = [
            'required' => ' :attribute wajib diisi!',
            'confirmed' => ' :attribute harus sama!',
            'unique' => ' Data telah terdaftar, gunakan data lain.'
        ];

        $request->validate([
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ], $message);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('login')->with('status', 'Password Berhasil Diupdate!');
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}
