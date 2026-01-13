<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $table = 'journals';

    // Kolom yang boleh diisi lewat mass assignment
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'emoji',
        'created_at',
    ];

    // created_at (tanpa updated_at)
    public $timestamps = false;

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
