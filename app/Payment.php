<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['examination_id', 'service_rendered', 'in_settlement_amount','fee', 'paid', 'balance'];
    
}
