<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable =[
        'name', 'lastname', 
        'document_type_id', 
        'number_document', 
        'telephone', 'address',
    ];

    public function sale()
    {
        return $this->hasOne('App\Models\Sale');
    }

}
