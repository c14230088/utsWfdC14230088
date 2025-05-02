<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'id',
        'jadwal_id',
        'nama_pemesan',
        'wa_pemesan',
        'tanggal',
    ];

    protected $hidden = ['created_at', 'protected_at'];

    public static function relations() {
        return ['jadwal'];
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwals::class, 'jadwal_id');
    }
}
