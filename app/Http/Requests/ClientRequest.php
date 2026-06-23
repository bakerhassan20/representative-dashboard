<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ];
    }
}