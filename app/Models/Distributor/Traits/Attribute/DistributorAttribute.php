<?php

namespace App\Models\Distributor\Traits\Attribute;

/**
 * Trait DistributorAttribute.
 */
trait DistributorAttribute
{
    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->contact_person_last_name
            ? $this->contact_person_first_name.' '.$this->contact_person_last_name
            : $this->contact_person_first_name;
    }

    /**
     * @return string
     */
    public function getCompleteNameAttribute()
    {
        return $this->full_name;
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.distributor.show', $this).'" class="btn btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (auth()->user()->can('edit distributor'))
            return '<a href="'.route('admin.distributor.edit', $this).'" class="btn btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
        else
            return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (auth()->user()->can('delete distributor'))
            return '<a href="' . route('admin.distributor.destroy', $this) . '"
                 data-method="delete"
                 data-trans-button-cancel="' . __('buttons.general.cancel') . '"
                 data-trans-button-confirm="' . __('buttons.general.crud.delete') . '"
                 data-trans-title="' . __('strings.backend.general.are_you_sure') . '"k
                 class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.delete') . '"></i></a> ';
        else
            return '';
    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute()
    {
        if (auth()->user()->can('force delete distributor'))
            return '<a href="'.route('admin.distributor.delete-permanently', $this).'" name="confirm_distributor" class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete Permanently"></i></a> ';
        else
            return '';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        if (auth()->user()->can('restore distributor'))
            return '<a href="'.route('admin.distributor.restore', $this).'" name="confirm_distributor" class="btn btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Restore Distributor"></i></a> ';
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
				<div class="btn-group btn-group-sm" role="group" aria-label="Distributor Actions">
				  '.$this->restore_button.'
				  '.$this->delete_permanently_button.'
				</div>';
        }

        return '
            <div class="btn-group btn-group-sm" role="group" aria-label="Distributor Actions">
            '.$this->show_button.'
            '.$this->edit_button.'
            '.$this->delete_button.'
            </div>';
    }
}
