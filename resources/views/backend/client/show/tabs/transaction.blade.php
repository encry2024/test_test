<div class="col">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->reference_id }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>