@extends ('backend.layouts.app')

@section ('title', __('labels.backend.distributors.management') . ' | ' . __('labels.backend.distributors.create'))

@section('breadcrumb-links')
    @include('backend.distributor.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.distributor.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.distributors.management') }}
                        <small class="text-muted">{{ __('labels.backend.distributors.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.distributor.name'))
                        ->class('col-md-2 form-control-label')

                        ->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.distributor.name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.distributor.contact_person_first_name'))->class('col-md-2 form-control-label')->for('contact_person_first_name') }}

                        <div class="col-md-10">
                            {{ html()->text('contact_person_first_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.distributor.contact_person_first_name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.distributor.contact_person_last_name'))->class('col-md-2 form-control-label')->for('contact_person_last_name') }}

                        <div class="col-md-10">
                            {{ html()->text('contact_person_last_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.distributor.contact_person_last_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.distributor.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.distributor.email'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.distributor.address'))->class('col-md-2 form-control-label')->for('address') }}

                        <div class="col-md-10">
                            {{ html()->text('address')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.distributor.address'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.distributor.contact_number'))
                        ->class('col-md-2 form-control-label')
                        ->for('contact_number') }}

                        <div class="col-md-10">
                            {{ html()->text('contact_number')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.distributor.contact_number'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.distributor.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->form()->close() }}
@endsection