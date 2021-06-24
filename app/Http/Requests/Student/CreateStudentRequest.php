<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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

    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome é obrigatório.',
            'email.required' => 'Campo email é obrigatório.',
            'email.email' => 'Email inválido.',
            'email.unique' => 'Email já cadastrado.',
            'cellphone.min' => 'Telefone não deve ser menor que 14 caracteres.',
            'cellphone.max' => 'Telefone não deve ser maior que 14 caracteres.',
        ];
    }
}
