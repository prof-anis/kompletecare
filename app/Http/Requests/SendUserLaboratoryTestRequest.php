<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendUserLaboratoryTestRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'laboratoryTests' => ['required', 'array', 'min:1'],
            'laboratoryTests.*' => [Rule::exists("laboratory_tests", "id")]
        ];
    }
}
