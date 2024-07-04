<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;
    protected $table='company';
    protected $fillable = ['name','email','contact','street','city','state','zip','country','logo','ein',
    'company_creation_date','website'];


    public function company_branches(){
        return $this->hasMany(branch::class,'company_id'); 
        

    }


}
