@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="alert alert-warning" role="alert">
        <i class="fa fa-warning"></i> THIS PAGE IS UNDER CONSTRUCTION!
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-7">
                    <h4 class="card-title mb-0">
                        {{ $client->name }}
                        <small class="text-muted">Create Transaction</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.client.name'))
                        ->class('col-md-2 form-control-label')
                        ->for('name') }}

                        <div class="col-md-10">
                            <input type="text" class="form-control" name="client_name" value="{{ $client->name }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.client.contact_person_first_name'))
                        ->class('col-md-2 form-control-label')
                        ->for('contact_person_first_name') }}

                        <div class="col-md-10">
                            <input type="text" class="form-control" name="client_name" value="{{ $client->contact_person_last_name }} {{ $client->contact_person_first_name }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.client.contact_person_email'))->class('col-md-2 form-control-label')->for('contact_person_email') }}

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="client_name" value="{{ $client->contact_person_email }}" disabled>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.client.contact_person_contact_number'))->class('col-md-2 form-control-label')->for('contact_person_contact_number') }}

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="client_name" value="{{ $client->contact_person_contact_number }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.client.address'))->class('col-md-2 form-control-label')->for('address') }}

                        <div class="col-md-10">
                            <input type="text" class="form-control" name="client_name" value="{{ $client->address }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <hr>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.client.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection
