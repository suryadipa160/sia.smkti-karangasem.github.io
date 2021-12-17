<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perusahaan extends Model
{
    protected $fillable = ['user_id','nama','tentang','alamat','website','no_telp', 'gambar'];
    public function lowongan()
    {
        return $this->hasMany(lowongan::class);
    }
    public function lamaran()
    {
        return $this->hasMany(lamaran::class);
    }
}