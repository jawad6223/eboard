<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscription_transaction extends Model
{
    use HasFactory;
    protected $fillable = ['branch_id','branch_email','transaction_id','payment_method','amount'];

 
}
