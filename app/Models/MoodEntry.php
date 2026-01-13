<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodEntry extends Model
{
    use HasFactory;

    protected $table = 'mood_entries';

    protected $fillable = [
        'user_id',
        'mood_id',
        'note',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    // Relasi ke Mood
    public function mood()
    {
        return $this->belongsTo(Mood::class, 'mood_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
