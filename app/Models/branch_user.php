<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class branch_user extends Model
{
    use HasFactory;

    protected $table='branch_user';
    protected $fillable = ['user_id','branch_id'];

    public function employee(){
        
        return $this->belongsTo(user::class,'user_id');    
    }
  
  
    public function employee_branch(){
      
        return $this->belongsTo(branch::class,'branch_id');    
    }


    
    


}
