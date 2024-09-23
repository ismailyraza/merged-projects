<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'event_id',
        'order_id',
        'amount',
        'timestamp',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    
    

}
