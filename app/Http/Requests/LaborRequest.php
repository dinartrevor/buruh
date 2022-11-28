<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaborRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'bonus' => ['required', 'integer'],
            ];
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'bonus' => ['required', 'string', 'max:255'],
        ];
    }
}
