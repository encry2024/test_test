@extends('frontend.layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>
                    <i class="fa fa-dashboard"></i> Client {{ __('navs.frontend.dashboard') }}
                </strong>
            </div><!--card-header-->

            <div class="card-body">
                <div class="row">
                    <div class="col col-sm-3 order-1 order-sm-2  mb-4">
                        <div class="card mb-4 bg-light">
                            <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture">

                            <div class="card-body">
                                <h4 class="card-title">
                                    {{ $logged_in_user->name }}<br/>
                                </h4>

                                <p class="card-text">
                                    <small>
                                        <i class="fa fa-envelope-o"></i> {{ $logged_in_user->email }}<br/>
                                        <i class="fa fa-calendar-check-o"></i> {{ __('strings.frontend.general.joined') }} {{ $logged_in_user->created_at->timezone(get_user_timezone())->format('F jS, Y') }}
                                    </small>
                                </p>

                                <p class="card-text">

                                    <a href="{{ route('frontend.user.account')}}" class="btn btn-info btn-sm mb-1">
                                        <i class="fa fa-user-circle-o"></i> {{ __('navs.frontend.user.account') }}
                                    </a>

                                    @can('view backend')
                                        &nbsp;<a href="{{ route ('admin.dashboard')}}" class="btn btn-danger btn-sm mb-1">
                                            <i class="fa fa-user-secret"></i> {{ __('navs.frontend.user.administration') }}
                                        </a>
                                    @endcan
                                </p>
                            </div>
                        </div>
                    </div><!--col-md-4-->

                    <div class="col-md-9 order-2 order-sm-1">
                        <div class="col">
                            <div class="table-responsive" style="font-size: 12px;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Transaction ID</th>
                                            <th>Delivered Item</th>
                                            <th>Delivered Stocks</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($client_transactions as $client_transaction)
                                            <tr>
                                                <td>{{ $client_transaction->transaction->reference_id }}</td>
                                                <td>{{ $client_transaction->inventory->name }}</td>
                                                <td>{{ number_format($client_transaction->delivered_stocks) }} {{ $client_transaction->inventory->unit_type->name }}</td>
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
