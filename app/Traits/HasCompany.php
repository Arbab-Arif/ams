<?php


namespace App\Traits;


use App\Scopes\CompanyScope;

trait HasCompany
{

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

}
