<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lamaran extends Model
{
    protected $table = 'lamaran';
    protected $fillable = ['alumni_id','lowongan_id','perusahaan_id','lamaran','cv','ijazah'];
    public function lowongan()
    {
        return $this->belongsTo(lowongan::class);
    }
    public function perusahaan()
    {
        return $this->belongsTo(perusahaan::class);
    }
    public function alumni()
    {
        return $this->belongsTo(alumni::class);
    }
}
