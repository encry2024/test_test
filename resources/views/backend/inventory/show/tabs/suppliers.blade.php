<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('labels.backend.distributors.table.name') }}</th>
                <th>Selling Price</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($item->distributors as $distributor_item)
            <tr>
                <td>{{ $distributor_item->name }}</td>
                <td>{{ $distributor_item->pivot->selling_price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>