<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'name' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'cf-turnstile-response' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Bidang nama wajib diisi.',
            'no_telp.required' => 'Bidang nomor telepon wajib diisi.',
            'no_telp.phone_number' => 'Nomor telepon tidak valid.',
            'email.required' => 'Bidang alamat email wajib diisi.',
            'description.required' => 'Bidang komentar wajib diisi.',
            'cf-turnstile-response.required' => 'Captcha wajib diselesaikan dahulu.',
        ];
    }
}
