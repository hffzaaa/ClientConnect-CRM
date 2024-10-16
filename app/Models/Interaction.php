<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $fillable = [
        'customer_id',
        'date_time',
        'typeinteraction',
        'notes',
    ];

    public function customer(){
        // belongsTo: many to one, each interaction belongs to a customer
        return $this->belongsTo(Customer::class); 
    }
}
