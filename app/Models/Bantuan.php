<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    use HasFactory;
    protected $table = 'bantuan';

    protected $fillable = [
        'email',
        'nomor_hp',
        'total_bantuan',
        'tanggal_pengambilan',
    ];

}