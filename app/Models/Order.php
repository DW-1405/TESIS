<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','supplier_id', 'date',
    ];

    
    public function supplier(){

        return $this->belongsTo('App\Models\Supplier');
    }

    public function user(){

        return $this->belongsTo('App\Models\User');
    }

}
