<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'activity_name',
        'description',
        'duration',
        'mood_id',
        'is_default'
    ];
}
