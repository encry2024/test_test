<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('menus.backend.clients.main') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.client.index') }}">{{ __('menus.backend.clients.all') }}</a>
                <a class="dropdown-item" href="{{ route('admin.client.create') }}">{{ __('menus.backend.clients.create') }}</a>
                <a class="dropdown-item" href="{{ route('admin.client.deleted') }}">{{ __('menus.backend.clients.deleted') }}</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>