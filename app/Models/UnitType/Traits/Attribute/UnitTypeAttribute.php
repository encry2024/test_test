<?php

namespace App\Models\UnitType\Traits\Attribute;

/**
 * Trait UnitTypeAttribute.
 */
trait UnitTypeAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (auth()->user()->can('edit inventory'))
            return '<a class="btn btn-primary"
            onclick="getUnitType('.$this->id.',\''.$this->name.'\', \''.$this->description.'\')"
            data-toggle="modal" data-target="#edit-unit-type-modal" >
            <i class="fa fa-pencil" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i>
            </a>';
        else
            return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (auth()->user()->can('delete inventory')) {
            return '<a href="'.route('admin.inventory.unit_type.destroy', $this).'"
                 data-method="delete"
                 data-trans-button-cancel="'.__('buttons.general.cancel').'"
                 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
                 data-trans-title="'.__('strings.backend.general.are_you_sure').'"
                 class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.delete').'"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group btn-group-sm" role="group" aria-label="UnitType Actions">'
        .$this->edit_button.
        $this->delete_button.
        '</div>';
    }
}
