<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Atlet extends Model
{
    use HasFactory;
    protected $table = 'atlet';
    protected $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function cabor(): BelongsTo
    {
        return $this->belongsTo(Cabor::class, 'id_cabor', 'id');
    }
    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten', 'id');
    }
    public function nomor_pertandingan(): BelongsTo
    {
        return $this->belongsTo(NomorPertandinganCabor::class, 'id_nomor_pertandingan_cabor', 'id');
    }
}