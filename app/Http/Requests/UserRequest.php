<?php

namespace App\Http\Requests;

class UserRequest extends Request
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
            'name' => 'filled|max:50',
            'email' => 'filled|email|unique:users,email,'.$this->segment(3),
            'user_type_id' => 'filled|integer'
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
        $input['email'] = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
        $input['user_type_id'] = filter_var($input['user_type_id'], FILTER_VALIDATE_INT);

        $this->replace($input);
    }
}