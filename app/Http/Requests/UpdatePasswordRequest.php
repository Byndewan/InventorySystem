<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required','min:8'],
            'password' => ['required', 'confirmed','min:8', Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'current_password.min' => 'Kata sandi minimal harus 8 karakter.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.confirmed' => 'Kata sandi Konfirmasi tidak cocok.',
            'password.min' => 'Kata sandi minimal harus 8 karakter.',
        ];
    }
}
