<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateThreadRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|between:5,50',
            'post'=>'required|between:5,2000',
            'forum_id'=>'required|exists:forums,id'
        ];
    }
}
