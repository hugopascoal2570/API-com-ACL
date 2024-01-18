<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends StorePermissionRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'name' => [
                    'required',
                    'min:3',
                    'max:255',
                    'string',
                ],
                'description' => [
                    'required',
                    'min:3',
                    'max:255',
                    'string'
                ]
            ];
    }
}