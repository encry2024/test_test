@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>
                    Client's Order for Transaction # {{ $transaction->reference_id }}
                </strong>
            </div><!--card-header-->

            <div class="card-body">
                <div class="row">
                    <div class="col-md-9 order-2 order-sm-1">
                        <div class="col">
                            <div class="table-responsive" style="font-size: 12px;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Delivered Item</th>
                                            <th>Delivered Stocks</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction->client_transactions as $client_transaction)
                                        <tr>
                                            <td>{{ $client_transaction->inventory->name }}</td>
                                            <td>{{ number_format($client_transaction->delivered_stocks, 2) }}</td>
                                            <td>PHP {{ number_format($client_transaction->total_price, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--col-md-8-->
                </div><!-- row -->
            </div> <!-- card-body -->
        </div><!-- card -->
    </div><!-- row -->
@endsection
