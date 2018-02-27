@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.distributors.management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.distributors.management') }} <small class="text-muted">{{ __('labels.backend.distributors.list') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.distributor.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('labels.backend.distributors.table.id') }}</th>
                                    <th>{{ __('labels.backend.distributors.table.name') }}</th>
                                    <th>{{ __('labels.backend.distributors.table.contact_person_first_name') }}</th>
                                    <th>{{ __('labels.backend.distributors.table.contact_person_last_name') }}</th>
                                    <th>{{ __('labels.backend.distributors.table.contact_number') }}</th>
                                    <th>{{ __('labels.backend.distributors.table.email') }}</th>
                                    <th>{{ __('labels.backend.distributors.table.created_at') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($distributors as $distributor)
                                    <tr>
                                        <td>{{ $distributor->id }}</td>
                                        <td>{{ $distributor->name }}</td>
                                        <td>{{ $distributor->contact_person_first_name }}</td>
                                        <td>{{ $distributor->contact_person_last_name }}</td>
                                        <td>{{ $distributor->contact_number }}</td>
                                        <td>{{ $distributor->email }}</td>
                                        <td>{{ date('F d, Y - h:i A', strtotime($distributor->created_at)) }}</td>
                                        <td>{!! $distributor->action_buttons !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $distributors->total() !!} {{ trans_choice('labels.backend.distributors.table.total', $distributors->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $distributors->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
