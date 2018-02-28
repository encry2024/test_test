<?php

namespace App\Http\Requests\Backend\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create client');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                           => 'required|max:60',
            'contact_person_first_name'      => 'required|max:60',
            'contact_person_last_name'       => 'required|max:60',
            'contact_person_email'           => ['required', 'email', 'max:191', Rule::unique('clients')],
            'contact_person_contact_number'  => 'required|max:13',
            'address'                        => 'required'
        ];
    }
}
