<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $fillable = [ //$fillable allows to pass large sets of data at once w proper control (x malicious attempt)
        'name',
        'email',
        'phone_number',
        'address',
        'notes',
    ];

    public function interaction(){
        // $this : refers to individual cust
        // hasMany(Interaction::class) : one to many, cust can have many interaction records
        return $this->hasMany(Interaction::class);
    }
}
