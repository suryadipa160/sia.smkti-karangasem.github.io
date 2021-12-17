<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('email', [AuthController::class, 'showFormEmail'])->name('email');
Route::post('email', [AuthController::class, 'password'])->name('password');
Route::get('reset', [AuthController::class, 'showFormReset'])->name('reset');
Route::post('confirm', [AuthController::class, 'confirm'])->name('confirm');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/index', 'HomeController@index');
Route::post('/upload/{alumni}', 'HomeController@upload');

Route::get('/alumni', 'AlumniController@index');
Route::get('/alumni/data', 'AlumniController@data');
Route::get('/alumni/create', 'AlumniController@create');
Route::get('/alumni/{alumni}', 'AlumniController@show');
Route::post('/alumni', 'AlumniController@store');
Route::delete('/alumni/{alumni}', 'AlumniController@destroy');
Route::get('/alumni/{alumni}/edit', 'AlumniController@edit');
Route::patch('/alumni/{alumni}', 'AlumniController@update');

Route::get('/perusahaan', 'PerusahaanController@index');
Route::get('/perusahaan/create', 'PerusahaanController@create');
Route::get('/perusahaan/{perusahaan}', 'PerusahaanController@show');
Route::get('/perusahaan/{perusahaan}/edit', 'PerusahaanController@edit');
Route::post('/perusahaan', 'PerusahaanController@store');
Route::delete('/perusahaan/{perusahaan}/delete', 'PerusahaanController@destroy');
Route::patch('/perusahaan/{perusahaan}', 'PerusahaanController@update');
// Auth::routes();

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/{profile}', 'ProfileController@profile');
Route::get('/profile/perusahaan/edit/{profile}', 'ProfileController@edit_perusahaan');
Route::get('/profile/alumni/edit/{profile}', 'ProfileController@edit_alumni');
Route::patch('/profile/alumni/{profile}', 'ProfileController@update_alumni');
Route::patch('/profile/perusahaan/{profile}', 'ProfileController@update_perusahaan');
Route::get('/profile/akun/edit/{profile}', 'ProfileController@akun');
Route::patch('/profile/akun/{profile}', 'ProfileController@update_akun');

Route::get('/lihatlowongan/{perusahaan}', 'LowonganController@lihat');
Route::get('/tambahlowongan', 'LowonganController@tampil');
Route::post('/lowongan/{perusahaan}', 'LowonganController@tambah');
Route::get('/detaillowongan/{lowongan}', 'LowonganController@detail');
Route::get('/editlowongan/{lowongan}', 'LowonganController@edit');
Route::patch('/lowongan/{lowongan}', 'LowonganController@update');

Route::get('/lowongan', 'LowonganController@index');
Route::get('/lowongan/kategori/cari/{kategori}', 'LowonganController@cari_kategori');
Route::get('/lowongan/perusahaan/cari/{perusahaan}', 'LowonganController@cari_perusahaan');
Route::get('/lowongan/perusahaan/{perusahaan}', 'LowonganController@hasil_perusahaan');
Route::get('/lowongan/kategori/{kategori}', 'LowonganController@hasil_kategori');
Route::get('/detail/{lowongan}', 'LowonganController@info');
Route::delete('/hapuslowongan/{lowongan}', 'LowonganController@destroy');

Route::get('/kategori', 'KategoriController@index');
Route::get('/kategori/tambah', 'KategoriController@tambah');
Route::post('/kategori', 'KategoriController@store');
Route::get('/kategori/edit/{kategori}', 'KategoriController@edit');
Route::patch('/kategori/{kategori}', 'KategoriController@update');
Route::delete('/kategori/{kategori}', 'KategoriController@destroy');

Route::get('/lamaran', 'LamaranController@index');
Route::get('/lamaran/{lowongan}/create', 'LamaranController@create');
Route::post('/lamaran/{lowongan}', 'LamaranController@store');

Route::get('/laporan/alumni', 'CetakController@alumni');
Route::get('/laporan/perusahaan', 'CetakController@perusahaan');
Route::get('/laporan/lowongan', 'CetakController@lowongan');
Route::get('/laporan/lamaran', 'CetakController@lamaran');
Route::post('/cetak', 'CetakController@cetak');