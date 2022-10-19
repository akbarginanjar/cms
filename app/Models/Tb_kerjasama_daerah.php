<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_kerjasama_daerah extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $guarded = ['id'];
    // protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function wilayah()
    {
        return $this->belongsTo(Tb_wilayah::class, 'id_wilayah');
    }
}
