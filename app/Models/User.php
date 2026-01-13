<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'membership',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    // ✅ RELASI KE MOOD ENTRY
    public function moodEntries()
    {
        return $this->hasMany(\App\Models\MoodEntry::class);
    }
}
