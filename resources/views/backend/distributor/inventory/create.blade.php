@extends ('backend.layouts.app')

@section ('title', __('labels.backend.inventories.management') . ' | ' . __('labels.backend.inventories.create'))

@section('breadcrumb-links')
    @include('backend.inventory.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.distributor.inventory.store'))->class('form-horizontal')->open() }}
    <input type="hidden" value="{{ $distributor->id }}" name="distributor">

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                         {{ __('labels.backend.distributors.management') }} <small class="text-muted">Add Inventory</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="#" class="btn btn-success ml-1" data-toggle="tooltip" title="Add Field" id="add-item-field-button"><i class="fa fa-plus"></i></a>
                    </div><!--btn-toolbar-->
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div id="field-container">
                        
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.distributor.show', $distributor->id), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection

@push('after-scripts')
    <script>
        $('#add-item-field-button').click(function() {
            const field_container = $('#field-container');
            const numericField  = document.getElementsByClassName('numeric-input');
            let html = "";

            html = "<div class='form-group row dynamic-field'>";
                html += "<label for='name' class='col-md-2 form-control-label'>Item Name</label>";
                html += "<div class='input-group col-md-10'>";
                    html += "<input name='name[]' id='name[]' class='form-control' required/>";
                    html += "<div class='input-group-append'>";
                        html += "<input type='text' class='numeric-input form-control' name='selling_price[]' id='selling_price[]' placeholder='Selling Price'>"
                        html += "<a href='#' class='btn btn-danger remove-item-field'>";
                            html += "<i class='fa fa-remove'></i>";
                        html += "</a>";
                    html += "</div>";
                html += "</div>";
            html += "</div>";

            field_container.append(html);

            for (let elementIndex=0; elementIndex<numericField.length; elementIndex++) {
                new Cleave(numericField[elementIndex], {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            }
        });

        $(document).on('click', '.remove-item-field', function() {
            const remove_button = $(this);

            remove_button.closest('.dynamic-field').remove();
        });
    </script>
@endpush