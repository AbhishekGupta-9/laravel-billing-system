<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerMaster extends Model
{
    protected $fillable = [
        'name', 'city','address'
    ];
}
