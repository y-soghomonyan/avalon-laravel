<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function contacts()
    {
        return $this->hasOne(Contact::class,'id', 'contact_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class,'id','country_id');
    }
    public function state()
    {
        return $this->hasOne(CountryState::class, 'id','state_id');
    }

    public function parentCompany()
    {
        return $this->hasOne(CompanyOrganization::class, 'id', 'company_organization_id');
    }
    public function companyTypes()
    {
        return $this->hasOne(CompanyType::class, 'id', 'company_id');
    }

}
