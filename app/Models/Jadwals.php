<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwals extends Model
{
    protected $fillable = [
        'id',
        'nomor_lapangan',
        'jam_mulai',
        'jam_selesai',
    ];

    protected $hidden = ['created_at', 'protected_at'];

    public static function relations() {
        return ['pesanan'];
    }
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'jadwal_id');
    }
}
