<?php

namespace App\Http\Requests\Student;

use App\Http\Requests\Request;

class CreateStudentRequest extends Request
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'cellphone' => 'nullable|min:11|max:11',
            'email' => 'required|email|max:255|unique:students,email',
            'birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'team_id' => 'nullable|exists:teams,id',
        ];
    }
}
