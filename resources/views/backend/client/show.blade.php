@extends ('backend.layouts.app')

@section ('title', __('labels.backend.clients.management') . ' | ' . __('labels.backend.clients.view'))

@section('breadcrumb-links')
    @include('backend.client.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.clients.management') }}
                        <small class="text-muted">{{ __('labels.backend.clients.view', ['client' => $client->name]) }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fa fa-user"></i> {{ __('labels.backend.clients.tabs.titles.overview') }}</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                            @include('backend.client.show.tabs.overview')
                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        <strong>{{ __('labels.backend.clients.tabs.content.overview.created_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($client->created_at)) }},
                        <strong>{{ __('labels.backend.clients.tabs.content.overview.updated_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($client->updated_at)) }}
                        @if ($client->trashed())
                            <strong>{{ __('labels.backend.clients.tabs.content.overview.deleted_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($client->deleted_at)) }}
                        @endif
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection
