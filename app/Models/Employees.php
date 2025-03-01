<?php

namespace App\Models;

use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employees extends Model
{
     /** @use HasFactory<\Database\Factories\UserFactory> */
     use HasFactory, Notifiable, HasRoles;


    protected $table='employees';
    protected $guarded=['id'];
    //  protected $fillable = [
    //      'user_id',
    //      'nip',
    //      'name',
    //      'address',
    //      'position',
    //      'region'
    //  ];


        public function user(){
            return $this->hasOne(User::class);
    }
}
