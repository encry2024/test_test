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
            'distributor'             => 'required',
            'inventory'               => 'required',
            'price_per_unit'          => 'max:20',
            'unit_type'               => 'required',
            'stock_limit'             => 'required',
            'critical_stocks_level'   => 'max:191'
        ];
    }
}
