<?php

namespace App\Http\Controllers\Students\Requests;

use App\Models\Student;
use Closure;

class UpdateStudentRequest extends StudentRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'last_name' => ['string', 'max:255'],
            'name' => ['string', 'max:255'],
            'second_name' => ['nullable', 'string', 'max:255'],
            'group_id.*' => ['required', 'integer', 'min:1'],
            'group_id' => ['required', 'array'],
            'id_number' => [
                'integer',
                'min:1',
                'max:99999999999999999',
                /** Проверка уникальности по действующим студенческим номерам */
                function (string $attribute, $value, Closure $fail): void {
                    if (Student::whereIdNumber((int)$value)
                        ->where('id', '!=', $this->route()->student->id ?? 0)
                        ->exists()) {
                        $fail(__('validation.id_number_unique'));
                    }
                },
            ],
        ];
    }
}
