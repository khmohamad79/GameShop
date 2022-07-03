<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'owner_firstname',
        'owner_lastname',
        'email',
        'phone',
        'name',
        'registration_number',
        'address',
        'bank_account'
    ];

    protected $visible = [
        'owner_firstname',
        'owner_lastname',
        'email',
        'phone',
        'name',
        'registration_number',
        'address',
        'bank_account'
    ];
}
