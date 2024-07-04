<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certificate_organization extends Model
{
    protected $table='certificate_organization';
    protected $fillable = ['name','logo'];
    use HasFactory;
}
