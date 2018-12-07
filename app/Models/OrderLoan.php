<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLoan extends Model
{
    //
    protected $table = 't_order_loan';
    protected $primaryKey = 'orderid';
    public $timestamps = false;
}
