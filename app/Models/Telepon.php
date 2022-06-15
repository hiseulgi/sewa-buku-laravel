<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Telepon extends Model {
    use HasFactory;

    protected $table = 'telepon';
    protected $fillable = ['id', 'nomor_telepon'];

    public function peminjam() {
        return $this->belongsTo('App\Models\DataPeminjam', 'id');
    }
}
