<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscription_package extends Model
{
    use HasFactory;
    protected $fillable = ['name','months','price','description'];
}
