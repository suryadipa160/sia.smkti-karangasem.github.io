<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lowongan extends Model
{
    protected $table = 'lowongan';
    protected $fillable = ['perusahaan_id','nama','kategori_id','deskripsi','persyaratan','tanggal_dibuat','tanggal_akhir','tersedia'];
    public function perusahaan()
    {
        return $this->belongsTo(perusahaan::class);
    }
    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }
    public function lamaran()
    {
        return $this->hasMany(lamaran::class);
    }
    public function lampiran()
    {
        return $this->hasMany(lampiran::class);
    }
}
