<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class user extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['verification','name','email','password','contact','street','city','state','zip','country','image','status',
    'ssn','role_id'];


    public function allsale(){
        
        return $this->hasMany(user_sale::class,'user_id');    
    }

}
