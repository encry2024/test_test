@extends ('backend.layouts.app')

@section ('title', __('labels.backend.inventories.management') . ' | ' . __('labels.backend.inventories.view'))

@section('breadcrumb-links')
    @include('backend.inventory.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.inventories.management') }}
                        <small class="text-muted">{{ __('labels.backend.inventories.view', ['item' => $item->name]) }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-inventory">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fa fa-user"></i> {{ __('labels.backend.inventories.tabs.titles.overview') }}</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                            @include('backend.inventory.show.tabs.overview')
                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        <strong>{{ __('labels.backend.inventories.tabs.content.overview.created_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($item->created_at)) }},
                        <strong>{{ __('labels.backend.inventories.tabs.content.overview.updated_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($item->updated_at)) }}
                        @if ($item->trashed())
                            <strong>{{ __('labels.backend.inventories.tabs.content.overview.deleted_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($item->deleted_at)) }}
                        @endif
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection
