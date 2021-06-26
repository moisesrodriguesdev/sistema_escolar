<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
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
            'year' => 'nullable|date_format:Y',
            'teach_level' => 'nullable|string',
            'serie' => 'nullable|string',
            'shift' => 'nullable|string',
            'school_id' => 'required|exists:schools,id',
        ];
    }
}
