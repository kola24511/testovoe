<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:guests,email',
            'phone' => 'required|string|unique:guests,phone',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Имя является обязательным полем.',
            'last_name.required' => 'Фамилия является обязательным полем.',
            'email.required' => 'Email является обязательным полем.',
            'phone.required' => 'Телефон является обязательным полем.',
        ];
    }
}
