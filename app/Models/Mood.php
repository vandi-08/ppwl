<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    protected $table = 'moods';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'emoji',
        'color',
    ];

    public function entries()
    {
        return $this->hasMany(\App\Models\MoodEntry::class, 'mood_id');
    }
}
