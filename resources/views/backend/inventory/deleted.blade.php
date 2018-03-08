@extends ('backend.layouts.app')

@section ('title', __('labels.backend.inventories.management') . ' | ' . __('labels.backend.inventories.deleted'))

@section('breadcrumb-links')
    @include('backend.inventory.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.inventories.management') }}
                        <small class="text-muted">{{ __('labels.backend.inventories.deleted') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('labels.backend.inventories.table.id') }}</th>
                                    <th>{{ __('labels.backend.inventories.table.name') }}</th>
                                    <th>{{ __('labels.backend.inventories.table.price_per_unit') }}</th>
                                    <th>{{ __('labels.backend.inventories.table.stocks') }}</th>
                                    <th>{{ __('labels.backend.inventories.table.deleted_at') }}</th>
                                    <th>{{ __('labels.general.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if ($inventories->count())
                                @foreach ($inventories as $inventory)
                                <tr>
                                    <td>{{ $inventory->id }}</td>
                                    <td>{{ $inventory->name }} - {{ $inventory->distributor_id == 0 ? 'N/A' : $inventory->distributor->name }}</td>
                                    <td>PHP {{ number_format($inventory->price_per_unit, 2) }}</td>
                                    <td>{{ number_format($inventory->stocks, 2) }} {{ $inventory->unit_type->name }}</td>
                                    <td>{{ date('F d, Y (h:i A)', strtotime($inventory->deleted_at)) }}</td>
                                    <td>{!! $inventory->action_buttons !!}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr><td colspan="9"><p class="text-center">{{ __('strings.backend.inventories.no_deleted') }}</p></td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $inventories->total() !!} {{ trans_choice('labels.backend.inventories.table.total', $inventories->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $inventories->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
