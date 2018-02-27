<?php

namespace App\Http\Requests\Backend\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create inventory');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                    => 'required|max:60',
            'distributor'             => 'required',
            'price_per_unit'          => 'required|max:20',
            'unit_type'               => 'required',
            'critical_stocks_level'   => 'required|max:191'
        ];
    }
}
