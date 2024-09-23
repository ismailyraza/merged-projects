<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizerPayment extends Model
{
    use HasFactory;

    protected $table = 'organizer_payments';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'amount',
        'timestamp',
        'status',
    ];
}
