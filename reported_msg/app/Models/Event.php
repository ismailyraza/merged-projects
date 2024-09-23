<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    public $timestamps = false;

    protected $fillable = [
        'organizer_id',
        'event_id',
        'event_name',
        'created_at',
    ];

    public function childEvents(){
        return $this->hasMany(childEvents::class, "event_id", 'event_id');
    }
}
