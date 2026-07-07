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
            'id_number' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'status' => 'required|in:active,inactive',
        ];
    }
}