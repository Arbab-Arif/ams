<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'type' => 'required'
        ];

        $rules = array_merge($rules, $this->getTypeRules($request));

        $request->validate($rules);

        Company::create($request->all());
        return redirect()->route('admin.company.index');
    }

    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $rules = [
            'name' => 'required',
            'type' => 'required'
        ];
        $rules = array_merge($rules, $this->getTypeRules($request));
        $request->validate($rules);

        if($request->get('type') == 'flexible'){
            $company->update([
                "name" => $request->get('name'),
                "type" => $request->get('type'),
                "hours" => $request->get('hours'),
                "time_in" => null,
                "time_out" => null
            ]);
        }
        if($request->get('type') == 'fixed'){
            $company->update([
                "name" => $request->get('name'),
                "type" => $request->get('type'),
                "hours" => null,
                "time_in" => $request->get('time_in'),
                "time_out" => $request->get('time_out')
            ]);
        }
//        $company->update($request->all());
        return redirect()->route('admin.company.index');
    }

    protected function getTypeRules(Request $request): array
    {
        if (!$request->has('type')) return [];

        $typeRules = [
            'fixed'    => [
                'time_in'  => 'required',
                'time_out' => 'required'
            ],
            'flexible' => [
                'hours' => 'required',
            ]
        ];

        return $typeRules[$request->get('type')];
    }

}
