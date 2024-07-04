<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reward extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','rewards_name','status','rewards_price','reward_target','description','target_start_date','target_end_date','branch_id'];

    public function branch_name(){
        
        return $this->belongsTo(branch::class,'branch_id');    
    }
}
