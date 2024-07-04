<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_sale extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','sales','date','branch_id'];

    public function employee(){
        
        return $this->belongsTo(user::class,'user_id');    
    }

     public function employee_detail(){
        
        return $this->belongsTo(user::class,'user_id');    
    }


}
