<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_certificate extends Model
{
    use HasFactory;
    protected $table='user_certificate';
    protected $fillable = ['license_number','certificate_name_id','certificate_organization_id','issue_date','expiry_date'
    ,'url','user_id','credential_id'];

    
    public function certificate_names(){
        
        return $this->belongsTo(certificate_name::class,'certificate_name_id');    
    }

    public function certificate_org(){
        
        return $this->belongsTo(certificate_organization::class,'certificate_organization_id');    
    }

    // public function user_certificate(){
        
    //     return $this->belongsTo(user::class,'user_id');    
    // }

}
