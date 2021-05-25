<?php

namespace App\Http\Requests\AccessManagement\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
        return [
            'name'          => 'required|unique:roles,name,' . $this->id . ',id',
            'menus'         => 'required|array',
            'menus.*'       => 'exists:menus,id',
            'permissions'   => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ];
    }
}
