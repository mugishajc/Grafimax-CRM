<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //

    protected $fillable = [
        'job_name','date','client','tel','item_description','item_size','item_quantity','item_price','total_price','received_by','performed_by','job_status','payment_status',
    ];
}
