<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alumni extends Model
{
	protected $fillable = ['user_id','nis','nama','alamat','tanggal_lahir','agama','jenis_kelamin','jurusan','lulusan','status','pesan','gambar','updated_at','created_at'];
	public function lamaran()
    {
        return $this->hasMany(lamaran::class);
    }
}
