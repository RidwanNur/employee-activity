<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SKP extends Model
{
    use HasFactory, Notifiable, HasRoles;
    protected $table='skp';
    protected $guarded=['id'];
}
