@extends ('backend.layouts.app')

@section ('title', __('labels.backend.distributors.management') . ' | ' . __('labels.backend.distributors.view'))

@section('breadcrumb-links')
    @include('backend.distributor.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.distributors.management') }}
                        <small class="text-muted">{{ __('labels.backend.distributors.view', ['distributor' => $distributor->name]) }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.distributor.inventory.create', $distributor) }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create Inventory"><i class="fa fa-archive"></i></a>
                    </div><!--btn-toolbar-->
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fa fa-user"></i> {{ __('labels.backend.distributors.tabs.titles.overview') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#inventory" role="tab" aria-controls="inventory" aria-expanded="true"><i class="fa fa-archive"></i> {{ __('labels.backend.distributors.tabs.titles.inventory') }}</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                            @include('backend.distributor.show.tabs.overview')
                        </div><!--tab-->

                        <div class="tab-pane" id="inventory" role="tabpanel" aria-expanded="true">
                            @include('backend.distributor.show.tabs.inventory')
                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        <strong>{{ __('labels.backend.distributors.tabs.content.overview.created_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($distributor->created_at)) }},
                        <strong>{{ __('labels.backend.distributors.tabs.content.overview.updated_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($distributor->updated_at)) }}
                        @if ($distributor->trashed())
                            <strong>{{ __('labels.backend.distributors.tabs.content.overview.deleted_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($distributor->deleted_at)) }}
                        @endif
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->

    {{--<script>
        $(function() {
            $(".requested-quantity").on('change', function() {
                var item_quantity_var   =   0,
                    diq                 =   $(this).closest('tr');

                item_quantity_var = $(this).val();
                // Debug
                console.log(item_quantity_var);
                // Debug - .data('item-quantity', item_quantity_var)
                diq.find(".order_btn").attr('data-item-quantity', item_quantity_var);

                if(item_quantity_var == 0) {
                    diq.find(".order_btn").attr('disabled', true);
                } else {
                    diq.find(".order_btn").removeAttr('disabled');
                }
            });

            $(".order_btn").on('click', function() {
                var item_id = $(this).data('value');
                var quantity = $(this).data('item-quantity');

                $.ajax({
                    type: "post",
                    url: "{{ route('admin.cart.store') }}",
                    data: {
                        _token:         '{{ csrf_token() }}',
                        item_id:        item_id,
                        quantity:       quantity,
                        supplier_id:    "{{ $distributor->id }}"
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        notific8("Product '" + data.name + "' has been added to queue.", {
                            life:    5000,
                            theme:  'materialish',
                            color:  'lilrobot'
                        });
                    }
                });
            });
        })
    </script>--}}
@endsection
