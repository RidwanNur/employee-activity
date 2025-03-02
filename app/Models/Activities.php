<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory, Notifiable, HasRoles;


    protected $table='activies';
    protected $guarded=['id'];
}
