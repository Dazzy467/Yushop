<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    public $table = 'barang';
    public $fillable = 
    [
        'namaBarang',
        'stokBarang',
        'hargaBarang',
        'status',
        'image_path',
    ];
}
