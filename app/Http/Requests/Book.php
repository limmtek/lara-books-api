<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class Book extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $currentYear = Carbon::now()->year;
        return [
            'name' => 'required|string|max:255',
            'year_of_writing' => 'required|integer|between:1901,' . $currentYear,
            'number_of_pages' => 'required|integer',
        ];
    }
}
