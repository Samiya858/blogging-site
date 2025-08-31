<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    // ✅ signup errors ko 'register' bag me bhejo
    protected $errorBag = 'register';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:30', 'alpha_dash', 'unique:users,username'],
            'email' => ['required', 'email', 'lowercase', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // confirmed -> password_confirmation
        ];
    }

    public function messages(): array
    {
        return [
            // ✅ yahi message show hoga jab passwords match na karen
            'password.confirmed' => 'Passwords do not match.',
        ];
    }

    // ✅ validation fail par signup tab active rakho
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()
                ->withErrors($validator, $this->errorBag)
                ->withInput()
                ->with('activeTab', 'signup')
        );
    }
}
