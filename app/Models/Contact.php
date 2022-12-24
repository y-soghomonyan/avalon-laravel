<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function ownerUser()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

//    public function parentContact()
//    {
//        return $this->hasOne(Companies::class, 'id', 'parent_id');
//    }

    public function parentCompany()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
    public function reportsTo()
    {
        return $this->hasOne(User::class, 'id', 'reports');
    }

    public function mailingAddress()
    {
        return $this->hasOne(User::class, 'id', 'mailing_address');
    }


}
