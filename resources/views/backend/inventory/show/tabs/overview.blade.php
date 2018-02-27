<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.name') }}</th>
                <td>{{ $item->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.distributor') }}</th>
                <td>{{ $item->distributor->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.item_size') }}</th>
                <td>{{ $item->item_size->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.stocks') }}</th>
                <td>{{ $item->stocks }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.price_per_unit') }}</th>
                <td>{{ $item->price_per_unit }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.created_at') }}</th>
                <td>{{ $item->created_at->diffForHumans() }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.inventories.tabs.content.overview.updated_at') }}</th>
                <td>{{ $item->updated_at->diffForHumans() }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->