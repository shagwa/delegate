<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TodoRequest extends Request
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
        return [
            "todo" => "required|max:250",
            "todo_time" => "required|date",
            "location" => "required",
            "benefit" => "required"
        ];
    }
}
