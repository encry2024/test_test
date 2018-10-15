<div class="col">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Created By</th>
                    <th>Status</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($client->transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->reference_id }}</td>
                            <td>{{ $transaction->user->first_name }} {{ $transaction->user->last_name }}</td>
                            <td>{!! $transaction->status == 'PENDING' ? "<label class='badge badge-warning'>$transaction->status</label>" : "<label class='badge badge-success'>$transaction->status</label>" !!}</td>
                            <td>{{ date('F d, Y (h:i A)', strtotime($transaction->created_at)) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Inventory Actions">
                                    <a href="{{ route('admin.client.transaction.show', $transaction->reference_id) }}" class="btn btn-info"><i class="fa fa-search"></i></a>
                                    <a href="{{ route('admin.client.transaction.destroy', ['client' => $client->id, 'transaction' => $transaction->id]) }}"
                                    data-method="delete"
                                    data-trans-button-cancel="{{ __('buttons.general.cancel') }}"
                                    data-trans-button-confirm="{{ __('buttons.general.crud.delete') }}"
                                    data-trans-title="{{ __('strings.backend.general.are_you_sure') }}"
                                    class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="{ {__('buttons.general.crud.delete') }}"></i></a>
                                </div>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>