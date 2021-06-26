<?php

namespace App\Http\Requests\Team;

use App\Http\Requests\Request;

class CreateTeamRequest extends Request
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
            'year' => 'required|date_format:Y',
            'teach_level' => 'required|string',
            'serie' => 'required|string',
            'shift' => 'required|string',
            'school_id' => 'required|exists:schools,id',
        ];
    }
}
