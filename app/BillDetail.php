<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $fillable = [
        'bill_header_id', 'item_id','rate','qty'
    ];

    public function item()
    {
        return $this->hasOne('\App\ItemMaster','id','item_id');
    }
}
