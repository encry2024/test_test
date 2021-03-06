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
                                            <th>Prepared by</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->reference_id }}</td>
                                                <td>{{ $transaction->user->first_name }} {{ $transaction->user->last_name }}</td>
                                                <td>{{ $transaction->status }}</td>
                                                <td><a style="padding: 5px; padding-bottom: 0px; padding-top: 0px;" href="{{ route('frontend.transaction.show', $transaction->id) }}" class="btn btn-success"><i class="fa fa-search"></i></a>
                                                <a onclick="receiveStatus({{ $transaction->id }});" data-toggle="modal" data-target="#change-receive-modal" style="padding: 5px; padding-bottom: 0px; padding-top: 0px;" class="btn btn-success"><i class="fa fa-check"></i></a>
                                                </td>
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

    <form method="POST" class="modal fade in" tabindex="-1" role="dialog" id="change-receive-modal">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Transaction Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Change this transaction status to Received?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function receiveStatus(transaction_id) {
            let url = "{{ route('frontend.transaction.received', ':transaction_id') }}";
                url = url.replace(':transaction_id', transaction_id);

            $("#change-receive-modal").attr('action', url);
        }
    </script>
@endsection
