<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    use HasFactory;

    protected $table='branch';
    protected $fillable = ['user_id','status','company_id','subscription_expiry','subscription_pkg_id','branch_number','email','contact','street','city','state','zip','country','is_headquater'];

    public function branch_company(){
        
        return $this->belongsTo(company::class,'company_id');    
    }
    public function branch_employee(){
        return $this->hasMany(branch_user::class,'branch_id');   
    }

    public function branch_reward(){
        return $this->hasMany(reward::class,'branch_id');   
    }


    public function branch_trans(){
        
        return $this->hasOne(branch_card::class,'branch_id');    
    }
    
 
}
