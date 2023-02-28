<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'     => 'required',
            'email'    => 'required|email|unique:admins,email,' . $this->sub_admin->id,
        ];

        if (isSuperAdmin()) {
            $rules['company_id'] = 'required';
        }

        if (isCompanyAdmin()) {
            $rules['department_id'] = 'required';
        }

        return $rules;
    }

}
