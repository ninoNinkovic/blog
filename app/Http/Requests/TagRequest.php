<?php

namespace App\Http\Requests;

class TagRequest extends Request
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
            'name' => 'required|max:100|unique:tags,name,'.$this->segment(3)
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

        $input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);

        $this->replace($input);
    }
}