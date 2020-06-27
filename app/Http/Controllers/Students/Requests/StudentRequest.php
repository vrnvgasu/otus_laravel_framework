<?php

namespace App\Http\Controllers\Students\Requests;

use App\Http\Requests\BaseFormRequest;

class StudentRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'group.integer' => __('validation.group_integer'),
            'course.integer' => __('validation.course_integer'),
            'id_number.integer' => __('validation.id_number_integer'),
            'last_name.max' => __('validation.last_name_max'),
        ];
    }
}
