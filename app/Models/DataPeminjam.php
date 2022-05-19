<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPeminjam extends Model {
    use HasFactory;

    protected $table = 'data_peminjams';

    public function telepon() {
        return $this->hasOne('App\Models\Telepon', 'id_peminjam');
    }
}
