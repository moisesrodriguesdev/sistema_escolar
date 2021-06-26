<?php

namespace App\Http\Requests\Student;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'name' => 'nullable',
            'cellphone' => 'nullable|min:11|max:11',
            'email' => 'nullable|email|max:255|unique:students,email',
            'birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'team_id' => 'nullable|exists:teams,id',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Email já cadastrado.'
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->input('email')) {
            /** @var Student $student */
            $student = Student::findOrFail($this->route('student'));
            if ($student->email === $this->input('email')) {
                $this->offsetUnset('email');
            }
        }
    }
}
