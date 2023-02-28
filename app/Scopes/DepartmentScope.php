<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class DepartmentScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        if (session()->has('department_id'))
            $builder->where('department_id', session('department_id'));
    }

}
