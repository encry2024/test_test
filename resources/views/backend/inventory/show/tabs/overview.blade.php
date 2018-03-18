<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.name') }}</th>
                <td>{{ $item->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.unit_type') }}</th>
                <td>{!! $item->unit_type_id == 0 ? 'N/A' : $item->unit_type->name !!}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.stocks') }}</th>
                <td>{!! $item->unit_type_id == 0 ? '0' : $item->stocks .' '. $item->unit_type->name !!}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.critical_stocks_level') }}</th>
                <td>{!! $item->unit_type_id == 0 ? '0' : $item->critical_stocks_level .' '. $item->unit_type->name !!}</td>
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