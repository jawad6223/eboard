<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class my_client extends Model
{
    use HasFactory;
 protected $table='my_clients';
    protected $fillable = ['id','employee_id','name','email','contact','date','subject','address'];



    

}
