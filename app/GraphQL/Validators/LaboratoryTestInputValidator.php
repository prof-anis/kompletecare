<?php

namespace App\GraphQL\Validators;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;

final class LaboratoryTestInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'laboratoryTests' => ['required', 'array', 'min:1'],
            'laboratoryTests.*' => [Rule::exists("laboratory_tests", "id")]
        ];
    }
}
