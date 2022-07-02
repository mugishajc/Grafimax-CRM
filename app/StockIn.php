<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    //
    protected $table = 'stockin';
    protected $fillable = [
        'product_name',
        'quantity',
        'product_unit',
        'cost_value',
        'done_by',
        'total_amount',
        'note',
        'status'
    ];


    protected $hidden = [

    ];

    public function unit()
    {
        return $this->hasOne('App\StockIn', 'id')->first();
    }
}
