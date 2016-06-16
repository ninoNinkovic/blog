<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticleRequest extends Request
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
        $this->sanitize();

        return [
            'subject_id' => 'required|integer',
            'title' => 'required|max:255',
            'sub_title' => 'max:255',
            'summary' => 'required',
            'details' => 'required',
            //'display' => 'required',
            //'tag_ids' => 'required|distinct'
        ];
    }

    /**
     * Sanitize inputs before validation.
     *
     * @return array
     */
    public function sanitize()
    {
        $this->merge(array_map('trim', $this->all()));

        $input = $this->all();

        $input['title'] = filter_var($input['title'], FILTER_SANITIZE_STRING);
        $input['sub_title'] = filter_var($input['sub_title'], FILTER_SANITIZE_STRING);
        $input['summary'] = filter_var($input['summary'], FILTER_SANITIZE_STRING);

        $this->replace($input);
    }
}
