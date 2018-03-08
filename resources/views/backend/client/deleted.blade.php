@extends ('backend.layouts.app')

@section ('title', __('labels.backend.clients.management') . ' | ' . __('labels.backend.clients.deleted'))

@section('breadcrumb-links')
    @include('backend.client.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.clients.management') }}
                        <small class="text-muted">{{ __('labels.backend.clients.deleted') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('labels.backend.clients.table.id') }}</th>
                                <th>{{ __('labels.backend.clients.table.name') }}</th>
                                <th>{{ __('labels.backend.clients.table.contact_person_first_name') }}</th>
                                <th>{{ __('labels.backend.clients.table.contact_person_last_name') }}</th>
                                <th>{{ __('labels.backend.clients.table.contact_person_email') }}</th>
                                <th>{{ __('labels.backend.clients.table.contact_person_contact_number') }}</th>
                                
                                <th>{{ __('labels.backend.clients.table.deleted_at') }}</th>
                                <th>{{ __('labels.general.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if ($clients->count())
                                @foreach ($clients as $client)
                                    <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->contact_person_first_name }}</td>
                                    <td>{{ $client->contact_person_last_name }}</td>
                                    <td>{{ $client->contact_person_email }}</td>
                                    <td>{{ $client->contact_person_contact_number }}</td>
                                    <td>{{ date('F d, Y (h:i A)', strtotime($client->deleted_at)) }}</td>
                                    <td>{!! $client->action_buttons !!}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr><td colspan="9"><p class="text-center">{{ __('strings.backend.clients.no_deleted') }}</p></td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $clients->total() !!} {{ trans_choice('labels.backend.clients.table.total', $clients->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $clients->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
