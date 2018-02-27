@extends ('backend.layouts.app')

@section ('title', __('labels.backend.inventories.management') . ' | ' . __('labels.backend.inventories.create'))

@section('breadcrumb-links')
    @include('backend.inventory.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.inventory.store'))->class('form-horizontal')->open() }}

    <div class="alert alert-info" role="alert">
        <i class="fa fa-info-circle"></i> Critical Stocks Level <strong>Unit Type</strong> is the same as unit type of Stocks...
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.inventories.management') }}
                        <small class="text-muted">{{ __('labels.backend.inventories.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventory.name'))
                        ->class('col-md-2 form-control-label')
                        ->for('name') }}

                        <div class="col-md-10">
                            {{
                                html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.inventory.name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus()
                            }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventory.distributor'))->class('col-md-2 form-control-label')->for('distributor') }}

                        <div class="col-md-10">
                            <select name="distributor" id="distributor-dropdown" class="form-control chosen-select">
                                <option value=""></option>
                                @foreach ($distributors as $distributor)
                                    <option value="{{ $distributor->id }}">{{ $distributor->name }}</option>
                                @endforeach
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventory.price_per_unit'))->class('col-md-2 form-control-label')->for('price_per_unit') }}

                        <div class="input-group col-sm-10">
                            <span class="input-group-prepend input-group-text">PHP</span>
                            {{
                                html()->text('price_per_unit')
                                ->class('form-control numeric-input')
                                ->placeholder(__('validation.attributes.backend.inventory.price_per_unit'))
                                ->attribute('maxlength', 191)
                                ->required()
                            }}
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.inventory.stocks'))
                        ->class('col-md-2 form-control-label')
                        ->for('stocks') }}

                        <div class="input-group col-md-10">
                            <span class="input-group-prepend">
                                <select name="unit_type" id="unit-type-dropdown" class="custom-select">
                                    <option selected disabled>-- Select Unit Type --</option>
                                    @foreach ($unit_types as $unit_type)
                                        <option value="{{ $unit_type->id }}">{{ $unit_type->name }}</option>
                                    @endforeach
                                </select>
                            </span>
                            {{ html()->text('stocks')
                                ->class('form-control numeric-input')
                                ->placeholder(__('validation.attributes.backend.inventory.stocks'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                            <div class="input-group-append">
                                {{ html()->text('critical_stocks_level')
                                ->class('form-control numeric-input')
                                ->placeholder(__('validation.attributes.backend.inventory.critical_stocks_level'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.inventory.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection