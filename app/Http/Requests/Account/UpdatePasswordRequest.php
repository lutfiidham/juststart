<?php

namespace App\Http\Requests\Account;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, request()->user()->password)) {
                        $fail(__('Your old password was incorrect'));
                    }
                }
            ],
            'new_password' => 'required|min:6',
            'confirm_new_password' => 'required|same:new_password'
        ];
    }
}
