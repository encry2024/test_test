<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.clients.tabs.content.overview.name') }}</th>
                <td>{{ $client->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.clients.tabs.content.overview.contact_person_first_name') }}</th>
                <td>{{ $client->contact_person_first_name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.clients.tabs.content.overview.contact_person_last_name') }}</th>
                <td>{{ $client->contact_person_last_name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.clients.tabs.content.overview.contact_person_email') }}</th>
                <td>{{ $client->contact_person_email }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.clients.tabs.content.overview.contact_person_contact_number') }}</th>
                <td>{{ $client->contact_person_contact_number }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.clients.tabs.content.overview.address') }}</th>
                <td>{{ $client->address }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.clients.tabs.content.overview.created_at') }}</th>
                <td>{{ $client->created_at->diffForHumans() }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.clients.tabs.content.overview.updated_at') }}</th>
                <td>{{ $client->updated_at->diffForHumans() }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->