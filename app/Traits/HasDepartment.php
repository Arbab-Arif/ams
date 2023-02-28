<?php


namespace App\Traits;


use App\Scopes\CompanyScope;
use App\Scopes\DepartmentScope;

trait HasDepartment
{

    protected static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
        static::addGlobalScope(new CompanyScope);
    }

}
