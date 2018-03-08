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
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group btn-group-sm" role="group" aria-label="UnitType Actions">'.$this->edit_button.'</div>';
    }
}
