<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{
    protected $fillable = [
        'name', 'rate'
    ];
}
