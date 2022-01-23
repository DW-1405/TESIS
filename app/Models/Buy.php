<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    
    use HasFactory;
    
    protected $fillable =[
        'order_id', 'date', 
        'state',
    ];

    public function user(){

        return $this->belongsTo('App\Models\User');
    }

    public function order(){

        return $this->belongsTo('App\Models\Order');
    }
}
