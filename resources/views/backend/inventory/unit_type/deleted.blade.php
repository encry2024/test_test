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
@endsection
