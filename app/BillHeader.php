<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillHeader extends Model
{
    protected $fillable = [
        'date', 'customer_id','total_amount'
    ];

    public function billDetails()
    {
        return $this->hasMany('\App\BillDetail','bill_header_id','id');
    }
    public function customer()
    {
        return $this->hasOne('\App\CustomerMaster','id','customer_id');
    }
}
