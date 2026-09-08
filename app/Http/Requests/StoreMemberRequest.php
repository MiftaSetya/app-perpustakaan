<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:200',
            'nim' => 'required|string|max:50',
            'email' => 'required|email',
            'nomor_telepon' => 'required|string|min:10|max:15',
            'alamat' => 'required|string|max:200',
            'status' => 'required|integer|in:0,1',
        ];
    }
}
