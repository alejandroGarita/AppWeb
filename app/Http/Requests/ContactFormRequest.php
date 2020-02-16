<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'name' => "required|max:50|string",
            'lastName1' => "required|max:50|string",
            'lastName2' => "required|max:50|string",
            'dni' => [
                'required',
                'numeric',
                'max:9999999999',
                Rule::unique('contacts', 'dni')->ignore($this->contact)
            ],
            'mail' => [
                'required',
                'email',
                'max:100',
                'string',
                Rule::unique('contacts', 'mail')->ignore($this->contact)
            ],
        ];
    }
}
