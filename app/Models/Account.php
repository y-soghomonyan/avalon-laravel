<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function accountTypes(){
        return $this->hasOne(CompanyType::class, 'id', 'account_type_id');
    }

    public function industriesTypes(){
        return $this->hasOne(IndustriesType::class, 'id', 'industry_id');
    }

    public function parentAccount(){
        return $this->hasOne(Account::class, 'id', 'parent_id');
    }

    public function ownerUser(){
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function contacts(){
        return $this->hasMany(Contact::class, 'account_id');
    }

}
