@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.inventories.management'))

@section('breadcrumb-links')
    @include('backend.inventory.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.inventories.management') }} <small class="text-muted">{{ __('labels.backend.inventories.list') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.inventory.includes.header-buttons')
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
                                    <th>{{ __('labels.backend.inventories.table.created_at') }}</th>
                                    <th>{{ __('labels.backend.inventories.table.updated_at') }}</th>
                                    <th>{{ __('labels.general.actions') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($inventories as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }} - {{ $item->distributor_id == 0 ? 'N/A' : $item->distributor->name }}</td>
                                    <td>PHP {{ number_format($item->price_per_unit, 2) }}</td>
                                    <td>{{ number_format($item->stocks, 2) }} {{ $item->unit_type->name }}</td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td>{{ $item->updated_at->diffForHumans() }}</td>
                                    <td>{!! $item->action_buttons !!}</td>
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
