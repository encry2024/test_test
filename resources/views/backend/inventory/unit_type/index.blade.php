@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.inventories.unit_types.management'))

@section('breadcrumb-links')
    <li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn" href="{{ route('admin.inventory.index') }}">Back to Inventory</a>
        </div><!--dropdown-->
        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.inventories.unit_types.management') }} <small class="text-muted">{{ __('labels.backend.inventories.unit_types.list') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.inventory.unit_type.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col-8">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Unit Type</th>
                                    <th>Description</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                    <th>{{ __('labels.general.actions') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($unit_types as $unit_type)
                                <tr>
                                    <td>{{ $unit_type->name }}</td>
                                    <td>{{ $unit_type->description }}</td>
                                    <td>{{ date('F d, Y (h:i A)', strtotime($unit_type->created_at)) }}</td>
                                    <td>{{ date('F d, Y (h:i A)', strtotime($unit_type->updated_at)) }}</td>
                                    <td>{!! $unit_type->action_buttons !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->

    <!-- Create Unit Type Modal -->
    <form action="{{ route('admin.inventory.unit_type.store') }}" method="POST" class="modal fade in" tabindex="-1" role="dialog" id="create-unit-type-modal">
        {{ csrf_field() }}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Unit Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-4 mb-4">
                        <div class="col">
                            <div class="form-group row">
                                <label for="name" class="col-md-3 form-control-label">Unit Type</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" name="name" required maxlength="20">
                                </div><!--col-->
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="description" class="col-md-3 form-control-label">Description</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="description" name="description" required maxlength="20">
                                </div><!--col-->
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Create</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" class="modal fade in" tabindex="-1" role="dialog" id="edit-unit-type-modal">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Unit Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-4 mb-4">
                        <div class="col">
                            <div class="form-group row">
                                <label for="edit-name" class="col-md-3 form-control-label">Unit Type</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="edit-name" name="name" required maxlength="20">
                                </div><!--col-->
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="edit-description" class="col-md-3 form-control-label">Description</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="edit-description" name="description" required maxlength="20">
                                </div><!--col-->
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function getUnitType(id, name, description) {
            let url = "{{ route('admin.inventory.unit_type.update', ':unit_type_id') }}";
                url = url.replace(':unit_type_id', id);

            document.getElementById('edit-name').value = name;
            document.getElementById('edit-description').value = description;

            $("#edit-unit-type-modal").attr('action', url);
        }
    </script>
@endsection
