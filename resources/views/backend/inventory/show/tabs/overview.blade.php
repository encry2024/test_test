<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.name') }}</th>
                <td>{{ $item->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.distributor') }}</th>
                @if (count($item->distributor))
                    @if ($item->distributor->trashed())
                        <td><a href="{{ route('admin.distributor.show', $item->distributor->id) }}">{{ $item->distributor->name }}</a> <span style="font-size: 10px;" class="badge badge-danger">Deleted | Recoverable</span></td>
                    @else
                        <td><a href="{{ route('admin.distributor.show', $item->distributor->id) }}">{{ $item->distributor->name }}</a></td>
                    @endif
                @else
                    <td><span class="badge badge-danger">Permanently Deleted</span></td>
                @endif
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.unit_type') }}</th>
                <td>{{ $item->unit_type->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.stocks') }}</th>
                <td>{{ $item->stocks }} {{ $item->unit_type->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.critical_stocks_level') }}</th>
                <td>{{ $item->critical_stocks_level }} {{ $item->unit_type->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.price_per_unit') }}</th>
                <td>{{ $item->price_per_unit }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.created_at') }}</th>
                <td>{{ date('F d, Y (h:i A)', strtotime($item->created_at)) }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.updated_at') }}</th>
                <td>{{ date('F d, Y (h:i A)', strtotime($item->updated_at)) }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->