<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateAppointment extends Model
{
    use HasFactory;

    public function roles(){
        return $this->belongsToMany(AppointmentsRole::class, 'appointments_role_relations', 'appointment_id', 'appointments_roles_id');
    }
    
    public function company(){
        return $this->hasOne(Company::class,'id', 'company_id');
    }
}
