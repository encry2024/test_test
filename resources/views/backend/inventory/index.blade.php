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
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#item_with_stocks" role="tab" aria-controls="item_with_stocks" aria-expanded="true">Item With Stocks</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#item_without_stocks" role="tab" aria-controls="item_without_stocks" aria-expanded="true">Item Without Stocks</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="item_with_stocks" role="tabpanel" aria-expanded="true">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('labels.backend.inventories.table.name') }}</th>
                                            <th>{{ __('labels.backend.inventories.table.stocks') }}</th>
                                            <th>{{ __('labels.backend.inventories.table.stock_limit') }}</th>
                                            <th>{{ __('labels.backend.inventories.table.created_at') }}</th>
                                            <th>{{ __('labels.backend.inventories.table.updated_at') }}</th>
                                            <th>{{ __('labels.general.actions') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($inventories as $item)
                                        @if ($item->stocks != 0)
                                        <tr
                                        @if ($item->stocks <= $item->critical_stocks_level)
                                            class="bg-warning" style="color: black;"
                                        @endif

                                        @if ($item->stock_limit < $item->stocks)
                                            class="row-bg-danger text-white"
                                        @endif
                                        >
                                            <td>{{ $item->name }}</td>
                                            <td>{{ number_format($item->stocks, 2) }} {!! $item->unit_type_id == 0 ? 'N/A' : $item->unit_type->name !!}</td>
                                            <td>{!! $item->unit_type_id == 0 ? 'N/A' : number_format($item->stock_limit, 2) .' '. $item->unit_type->name !!}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td>{{ $item->updated_at->diffForHumans() }}</td>
                                            <td>{!! $item->action_buttons !!}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!--tab-->

                        <div class="tab-pane" id="item_without_stocks" role="tabpanel" aria-expanded="true">
                        <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('labels.backend.inventories.table.name') }}</th>
                                            <th>{{ __('labels.backend.inventories.table.stocks') }}</th>
                                            <th>{{ __('labels.backend.inventories.table.stock_limit') }}</th>
                                            <th>{{ __('labels.backend.inventories.table.created_at') }}</th>
                                            <th>{{ __('labels.backend.inventories.table.updated_at') }}</th>
                                            <th>{{ __('labels.general.actions') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($inventories as $item)
                                        @if (($item->stocks != 0) && ($item->stocks < 0))
                                        <tr
                                        @if ($item->stocks = 0)
                                            class="bg-danger" style="color: white;"
                                        @endif
                                        >
                                            <td>{{ $item->name }}</td>
                                            <td>{{ number_format($item->stocks, 2) }} {!! $item->unit_type_id == 0 ? 'N/A' : $item->unit_type->name !!}</td>
                                            <td>{!! $item->unit_type_id == 0 ? 'N/A' : number_format($item->stock_limit, 2) .' '. $item->unit_type->name !!}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td>{{ $item->updated_at->diffForHumans() }}</td>
                                            <td>{!! $item->action_buttons !!}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!--tab-->
                    </div><!--tab-content-->
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

    <form class="modal fade in" tabindex="-1" role="dialog" id="update_stock_form" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Item Stocks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mt-4 mb-4">
                        <div class="col">
                            <div class="form-group row">
                                <label for="edit-stocks" class="col-md-3 form-control-label">Stocks</label>

                                <div class="col-md-9">
                                    <input type="number" class="form-control" id="edit-stocks" name="stocks" required min="0">
                                </div><!--col-->
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade in" tabindex="-1" role="dialog" id="stock_limit_reached_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Stock Limit Reached</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-4 mb-4">
                        <div class="col">
                        <p>Item has reached maximum stock limit. Would you like to restock?</p>
                        </div>
                    </div><!--row-->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-toggle="modal" data-target="#update_stock_form" onclick="closeActiveModal(document.getElementById('stock_limit_reached_modal'));">Re-stock Anyway</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getUnitType(id, stocks)
        {
            let url = "{{ route('admin.inventory.update.stocks', ':item_id') }}";
                url = url.replace(':item_id', id);

            document.getElementById('edit-stocks').value = stocks;

            $("#update_stock_form").attr('action', url);
        }

        function closeActiveModal(modal)
        {
            $(modal).toggle();
            $('.modal-backdrop').remove();
        }
    </script>
@endsection
