<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable =[
        'name', 'lastname', 
        'document_type_id', 
        'number_document', 
        'date_birth', 'email',
        'telephone', 'address',
        'workstation_id',
    ];

	public function document_type(){

        return $this->belongsTo('App\Models\DocumentType');
    }

    
	public function workstation(){

        return $this->belongsTo('App\Models\Workstation');
    }


    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

}
