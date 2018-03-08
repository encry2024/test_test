<?php

namespace App\Http\Requests\Backend\Inventory\UnitType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('edit inventory');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|unique:unit_types,name,'.$this->unit_type->id.'|max:20',
            'description'   => 'required|max:60'
        ];
    }
}
