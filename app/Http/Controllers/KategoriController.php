<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = kategori::all();
        return view('kategori.index', ['kategori' => $kategori]);
    }
    public function tambah()
    {
        return view('kategori.tambah');
    }
    public function store(Request $request)
    {
        $message = [
            'required' => ' :attribute wajib diisi!'
        ];

        $request->validate([
            'nama' => 'required'
        ], $message);

        $data = [
        	'nama' => $request->nama
        ];
        kategori::create($data);
        return redirect('/kategori')->with('status', 'Data Berhasil Ditambahkan');
    }
    public function edit(kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }
    public function update(Request $request, kategori $kategori)
    {
        $data = [
            'nama' => $request->nama
        ];
        kategori::where('id', $kategori->id)->update($data);
        return redirect('/kategori')->with('status', 'Data Berhasil Diubah');
    }
    public function destroy(kategori $kategori)
    {
        kategori::destroy($kategori->id);
        return redirect('/kategori')->with('status', 'Data Berhasil Dihapus');
    }
}
