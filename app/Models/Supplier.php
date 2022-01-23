<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'company_name', 
        'document_type_id', 
        'number_document', 
        'telephone', 'address',
        'email',
    ];

    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }

}
