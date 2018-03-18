@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">
                {{ $client->name }}
                <small class="text-muted">Create Transaction</small>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">
                            Client Details
                        </h4>
                    </div>
                    <hr>
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.client.name'))
                        ->class('col-md-12 form-control-label')
                        ->for('name') }}

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="client_name" value="{{ $client->name }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.client.contact_person_first_name'))
                        ->class('col-md-12 form-control-label')
                        ->for('contact_person_first_name') }}

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="client_name" value="{{ $client->contact_person_last_name }} {{ $client->contact_person_first_name }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.client.contact_person_email'))->class('col-md-12 form-control-label')->for('contact_person_email') }}

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="client_name" value="{{ $client->contact_person_email }}" disabled>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.client.contact_person_contact_number'))->class('col-md-12 form-control-label')->for('contact_person_contact_number') }}

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="client_name" value="{{ $client->contact_person_contact_number }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.client.address'))->class('col-md-12 form-control-label')->for('address') }}

                        <div class="col-md-12">
                            <textarea type="textarea" class="form-control" name="client_name" disabled>{{ $client->address }}</textarea>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.client.contact_person_contact_number'))->class('col-md-12 form-control-label')->for('contact_person_contact_number') }}

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="client_name" value="{{ $client->contact_person_contact_number }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--card-body-->
            </div> <!-- card -->
        </div><!-- col-client-details -->

        <div class="col-sm-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4 class="mb-0">
                                    Transaction
                                </h4>
                            </div>

                            <hr>

                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <div class="form-group row">
                                        {{ html()->label(__('validation.attributes.backend.inventory.name'))->class('col-md-2 form-control-label')->for('inventory') }}

                                        <div class="input-group col-md-10">
                                            <select name="inventory" id="inventory-dropdown" class="form-control chosen-select">
                                                <option value=""></option>
                                                @foreach ($inventories as $inventory)
                                                    <option value="{{ $inventory->id }}">{!! $inventory->name !!}</option>
                                                @endforeach
                                            </select>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        {{ html()->label(__('validation.attributes.backend.inventory.stocks'))->class('col-md-2 form-control-label')->for('inventory') }}

                                        <div class="input-group col-md-10">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="unit-type">N/A</span>
                                            </div>
                                            {{ 
                                                html()->text('stocks')
                                                ->class('form-control')
                                                ->placeholder(__('validation.attributes.backend.inventory.stocks'))
                                                ->attribute('maxlength', 191)
                                                ->attribute('min', 0)
                                                ->required() 
                                            }}
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="critical-stocks">0</span>
                                            </div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <button class="btn btn-dark pull-right" id="add-btn">Add</button>
                                </div><!-- col -->
                            </div><!-- row -->
                            
                            <table class="table table-bordered">
                                <thead>
                                    <th>Inventory</th>
                                    <th>Ordered Quantity</th>
                                    <th>Price/Unit</th>
                                    <th>Total Price</th>
                                </thead>
                                <tbody id="orders-table">
                                </tbody>
                            </table>
                        </div><!-- card-body -->
                        <div class="card-footer clearfix bg-white">
                            <div class="row">
                                <div class="col">
                                    {{ form_cancel(route('admin.client.index'), __('buttons.general.cancel')) }}
                                </div><!--col-->

                                <div class="col text-right">
                                    <button class="btn btn-success" id="transact_button">Transact</button>
                                </div><!--col-->
                            </div><!--row-->
                        </div><!--card-footer-->
                    </div><!-- card -->
                </div><!-- col -->
            </div><!-- row -->
        </div><!--col-transaction-->
    </div><!-- row -->
@endsection

@push('after-scripts')
<script>
    function removeProduct(arr) {
        var what, a = arguments, L = a.length, ax;
        while (L > 1 && arr.length) {
            what = a[--L];
            while ((ax= arr.indexOf(what)) !== -1) {
                arr.splice(ax, 1);
            }
        }
        return arr;
    }
    
    $(function() {
        // Constant Variables
        const unit_type_label   = $('#unit-type'),
        stocks_field            = $('#stocks'),
        critical_stocks_field   = $('#critical-stocks'),
        add_button              = $('#add-btn'),
        orders_container        = $('#orders-table'),
        transact_button         = $('#transact_button');
        // Assignable Variables
        let max_stocks          = 0,
        item_id                 = 0,
        html                    = "",
        item_verifier           = Array(),
        obj                     = {};

        $('#inventory-dropdown').on('change', function() {
            item_id = $(this).val();

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.inventory.get_item') }}",
                data: {
                    _token:  '{{ csrf_token() }}',
                    item_id: item_id
                },
                dataType: 'JSON',
                success: function(data) {
                    // Show returned object.
                    console.log(data);
                    // Execution
                    unit_type_label.text(data.unit_type.name);
                    critical_stocks_field.text(data.stocks);
                    max_stocks = data.stocks;
                    // Set attributes
                    stocks_field.attr('max', data.stocks);
                }
            });
        });

        stocks_field.on('keypress', function(e) {
            // console.log(max_stock);
            let currentValue    = String.fromCharCode(e.which);
            let value           = $(this).val() + currentValue;
            let finalValue      = parseFloat(parseFloat(value).toFixed(2));
            let formattedStock  = parseFloat(parseFloat(max_stocks).toFixed(2));

            if(finalValue >= formattedStock) {
                e.preventDefault();
                stocks_field.val(parseFloat(max_stocks));
            }
        });

        add_button.on('click', function() {
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.inventory.get_item') }}",
                data: {
                    _token:  '{{ csrf_token() }}',
                    item_id: item_id
                },
                dataType: 'JSON',
                success: function(data) {
                    let total_price = 0;
                    // Multiply the requested stock to the price per unit of the item
                    total_price = (parseFloat(stocks_field.val()) * parseFloat(data.price_per_unit)).toFixed(2);
                    // Validate if the array contains the ID of the requested item
                    if ( !item_verifier.contains(data.id)) {
                        html = "<tr id='product-container'>";
                        html += "<td>"+data.name+"</td>";
                        html += "<td>"+stocks_field.val()+"</td>";
                        html += "<td>"+data.price_per_unit+"</td>";
                        html += "<td>"+total_price+"</td>";
                        html += "</tr>";
                        // Create associative array to pass on the store transaction request
                        obj[data.id] = stocks_field.val();
                        // Push the item on the array to verify if the next item is in the array container
                        item_verifier.push(data.id);
                        // Append the HTML to the table
                        orders_container.append(html);
                    } else {
                        notific8("Item '" + data.name + "' is already in the list.", {
                            life:    5000,
                            theme:  'materialish',
                            color:  'lilrobot'
                        });
                    }
                }
            });
        });
        // 
        transact_button.on('click', function() {
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.client.transaction.store') }}",
                data: {
                    _token:  '{{ csrf_token() }}',
                    orders: obj,
                    client: '{{ $client->id }}'
                },
                dataType: 'JSON',
                success: function(data) {
                    window.location.href = data;
                }
            });
        })
    });
</script>
@endpush
