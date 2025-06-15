<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorPertandinganCabor extends Model
{
    use HasFactory;
    protected $table = 'nomor_pertandingan_cabor';
    protected $guarded = [];
    protected $casts = [
        'sub_nomor_pertandingan' => 'array',
    ];
}