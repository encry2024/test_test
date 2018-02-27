<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.distributors.tabs.content.overview.name') }}</th>
                <td>{{ $distributor->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.distributors.tabs.content.overview.contact_person_first_name') }}</th>
                <td>{{ $distributor->contact_person_first_name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.distributors.tabs.content.overview.contact_person_last_name') }}</th>
                <td>{{ $distributor->contact_person_last_name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.distributors.tabs.content.overview.email') }}</th>
                <td>{{ $distributor->email }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.distributors.tabs.content.overview.address') }}</th>
                <td>{{ $distributor->address }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.distributors.tabs.content.overview.mobile_number') }}</th>
                <td>{{ $distributor->contact_number }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.distributors.tabs.content.overview.created_at') }}</th>
                <td>{{ $distributor->created_at->diffForHumans() }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.distributors.tabs.content.overview.updated_at') }}</th>
                <td>{{ $distributor->updated_at->diffForHumans() }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->