<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'foto',
        'kategori_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
}
