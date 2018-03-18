<?php

namespace App\Models\Client\Traits\Attribute;

/**
 * Trait ClientAttribute.
 */
trait ClientAttribute
{
    public function getContactPersonFullNameAttribute()
    {
        return $this->contact_person_first_name . ' ' . $this->contact_person_last_name;
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.client.show', $this).'" class="btn btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'"></i></a>';
    }

    public function getTransactionButtonAttribute()
    {
        return '<a href="'.route('admin.client.transaction.create', $this).'" class="btn btn-success"><i class="fa fa-truck" data-toggle="tooltip" data-placement="top" title="Make Transaction"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (auth()->user()->can('edit client'))
            return '<a href="'.route('admin.client.edit', $this).'" class="btn btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
        else
            return '';
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
        if (auth()->user()->can('delete client'))
            return '<a href="'.route('admin.client.destroy', $this).'"
                 data-method="delete"
                 data-trans-button-cancel="'.__('buttons.general.cancel').'"
                 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
                 data-trans-title="'.__('strings.backend.general.are_you_sure').'"
                 class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.delete').'"></i></a> ';
        else
            return '';
    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute()
    {
        if (auth()->user()->can('force delete client'))
            return '<a href="'.route('admin.client.delete-permanently', $this).'"
            data-trans-button-cancel="Cancel"
            data-trans-button-confirm="Yes, Delete Permanently"
            data-trans-title="Are you sure you want to delete this data permanently?"
            name="confirm_item" class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete Permanently"></i></a> ';
        else
            return '';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        if (auth()->user()->can('restore client'))
            return '<a href="'.route('admin.client.restore', $this).'" 
            data-trans-button-cancel="Cancel"
            data-trans-button-confirm="Yes, Restore"
            data-trans-title="Are you sure you want to restore this data?"
            name="confirm_item" class="btn btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Restore Client"></i></a> ';
        else
            return '';
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
            '.$this->transaction_button.'
            '.$this->show_button.'
            '.$this->edit_button.'
            '.$this->delete_button.'
            </div>';
    }
}
