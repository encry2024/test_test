<?php

namespace App\Models\Client\Traits\Attribute;

/**
 * Trait ClientAttribute.
 */
trait ClientAttribute
{
    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.client.show', $this).'" class="btn btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getOrderButtonAttribute()
    {
        return '<a href="'.route('admin.client.order', $this).'" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Make an Order"><i class="fa fa-truck" data-toggle="tooltip" data-placement="top"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.client.edit', $this).'" class="btn btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
    }

    /**
     * @return string
     */
    /*public function getDeliverButtonAttribute()
    {
        return '<a href="'.route('admin.client.show', $this).'" class="btn btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'"></i></a>';
    }*/

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if ($this->id) {
            return '<a href="'.route('admin.client.destroy', $this).'"
                 data-method="delete"
                 data-trans-button-cancel="'.__('buttons.general.cancel').'"
                 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
                 data-trans-title="'.__('strings.backend.general.are_you_sure').'"
                 class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.delete').'"></i></a> ';
        }
    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute()
    {
        return '<a href="'.route('admin.client.delete-permanently', $this).'" name="confirm_customer" class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete Permanently"></i></a> ';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        return '<a href="'.route('admin.client.restore', $this).'" name="confirm_customer" class="btn btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Restore Client"></i></a> ';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->trashed()) {
            return '
                <div class="btn-group btn-group-sm" role="group" aria-label="Client Actions">
                  '.$this->restore_button.'
                  '.$this->delete_permanently_button.'
                </div>';
        }

        return '
            <div class="btn-group btn-group-sm" role="group" aria-label="Client Actions">
            '.$this->order_button.'
            '.$this->show_button.'
            '.$this->edit_button.'
            '.$this->delete_button.'
            </div>';
    }
}
