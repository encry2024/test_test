@extends ('backend.layouts.app')

@section ('title', __('labels.backend.distributors.management') . ' | ' . __('labels.backend.distributors.deleted'))

@section('breadcrumb-links')
    @include('backend.distributor.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.distributors.management') }}
                        <small class="text-muted">{{ __('labels.backend.distributors.deleted') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
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

                            @if ($distributors->count())
                                @foreach ($distributors as $distributor)
                                    <tr>
                                        <td>{{ $distributor->id }}</td>
                                        <td>{{ $distributor->name }}</td>
                                        <td>{{ $distributor->contact_person_first_name }}</td>
                                        <td>{{ $distributor->contact_person_last_name }}</td>
                                        <td>{{ $distributor->contact_number }}</td>
                                        <td>{{ $distributor->email }}</td>
                                        <td>{{ date('F d, Y (h:i A)', strtotime($distributor->deleted_at)) }}</td>
                                        <td>{!! $distributor->action_buttons !!}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="9"><p class="text-center">{{ __('strings.backend.distributors.no_deleted') }}</p></td></tr>
                            @endif
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
