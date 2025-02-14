<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'hrn',
        'lastname',
        'firstname',
        'middlename',
        'dob',
        'civilstatus',
        'sex',
        'contact',
        'street',
        'citymun',
        'barangay',
        'district',
        'zipcode',
        'status',
    ];

    public function scopeSearch($query, $val){
        return $query->where(function($q) use ($val) {
            $q->where('hrn', 'like', '%'.$val.'%')
              ->orWhere('firstname', 'like', '%'.$val.'%')
              ->orWhere('lastname', 'like', '%'.$val.'%')
              ->orWhere('dob', 'like', '%'.$val.'%')
              ->orWhere('barangay', 'like', '%'.$val.'%');
        });
    }
}
