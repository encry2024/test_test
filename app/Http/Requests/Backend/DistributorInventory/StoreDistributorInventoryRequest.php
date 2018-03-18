<?php

namespace App\Http\Requests\Backend\DistributorInventory;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistributorInventoryRequest extends FormRequest
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
            'distributor'   =>  'required',
            'inventory'     =>  'required|unique:distributor_inventory,distributor_id,'.$request->distributor
        ];
    }
}
