<?php

namespace App\Models;

use App\Models\SKP;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activities extends Model
{
    use HasFactory, Notifiable, HasRoles;


    protected $table='activities';
    protected $guarded=['id'];

    public function skp()
    {
        return $this->belongsTo(SKP::class, 'skp_id', 'id');
    }
}
