<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildEvent extends Model
{
    use HasFactory;

    protected $table = 'child_events';

    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'amount',
        'location',
        'version',
    ];
}
