@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.inventories.management'))


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Transaction Management <small class="text-muted">Transaction List</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Created By</th>
                                    <th>Client</th>
                                    <th>Date Created</th>
                                    <th>{{ __('labels.general.actions') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->reference_id }}</td>
                                    <td>{{ $transaction->user->full_name }}</td>
                                    <td>{{ $transaction->accounted_client->client->name }}</td>
                                    <td>{{ date('F d, Y (h:i A)', strtotime($transaction->created_at)) }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Inventory Actions">
                                            <a class="btn btn-info" href="{{ route('admin.client.show', $transaction->accounted_client->client->id) }}"><i class="fa fa-search"></i></a>
                                        </div>
                                    </td>
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
                        {!! $transactions->total() !!} {{ trans_choice('labels.backend.transactions.table.total', $transactions->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $transactions->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
