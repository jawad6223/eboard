<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class branch_card extends Model
{
    use HasFactory;
    protected $fillable = ['branch_id','card_name','card_number','cvc','expiration_month','expiration_year'];


    // public function branch_card(){
     
    //     return $this->hasOne(branch::class,'branch_id');    
    // }

}
