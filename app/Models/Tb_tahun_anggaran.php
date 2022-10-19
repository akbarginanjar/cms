<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_tahun_anggaran extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $guarded = ['id'];
    // protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function anggarans()
    {
        return $this->belongsTo(Tb_anggaran::class, 'id_anggaran');
    }
}
