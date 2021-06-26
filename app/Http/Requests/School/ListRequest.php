<?php

namespace App\Http\Requests\School;

use App\Http\Requests\Request;

class ListRequest extends Request
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
            'current_page' => 'nullable|integer',
            'order' => 'nullable|in:ASC,DESC,asc,desc',
            'order_by' => 'nullable|in:id',
            'page' => 'nullable|integer',
        ];
    }
}
