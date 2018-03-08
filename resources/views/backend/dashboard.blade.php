@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</strong>
                </div><!--card-header-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">
                        User Activities
                    </h4>
                    <div class="table-responsive">
                        <table id="entries" class="table" style="word-break: break-word;">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Header</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($entries as $key => $entry)
                                    <tr>
                                        <td>{{ $entry->datetime->format('F d, Y (h:i A)') }}</td>
                                        <td>
                                            {!! $entry->header !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <span class="badge badge-default">{{ __('log-viewer::general.empty-logs') }}</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!--table-responsive-->
                </div><!--card-body-->
            </div>
        </div><!-- col-8 -->

        <div class="col-4">
            <div class="list-group">
                <li href="#" class="list-group-item disabled" style="cursor: default; font-size: 15px;"><i class="fa fa-edit"></i> Activities to do
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a title="Create New Activity" class="list-group-item bg-success text-white text-center" data-toggle="modal" data-target="#create-todo-modal" 
                        style="padding: 5px;
                            padding-bottom: 0px;
                            padding-top: 0px;">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </li>
                @if (count($todos) != 0)
                    @foreach ($todos as $todo)
                        @if ($todo->priority_level == "HIGH")
                            <a href="#" 
                            data-toggle="modal"
                            data-target="#show-to-do-modal"
                            class="list-group-item list-group-item-action flex-column align-items-start todo-bg-danger text-white">
                                <div class="d-flex w-100 justify-content-between">
                                    
                                    <h5 class="mb-1">{{ $todo->title }}</h5>
                                    <small>{{ date('F d, Y (h:i A)', strtotime($todo->created_at)) }} | {{ $todo->user->full_name }}</small>
                                </div>
                                <small style="font-size: 80%; font-weight: 700;">Priority: {{ $todo->priority_level }}</small>
                            </a>
                        @else
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">

                                <div class="d-flex w-100 justify-content-between">
                                    
                                    <h5 class="mb-1">{{ $todo->title }}</h5>
                                    <small>{{ date('F d, Y (h:i A)', strtotime($todo->created_at)) }} | {{ $todo->user->full_name }}</small>
                                </div>
                                <small style="font-size: 80%; font-weight: 700;">Priority: {{ $todo->priority_level }}</small>
                            </a>
                        @endif
                    @endforeach
                @else
                    <li href="#" class="list-group-item disabled" style="cursor: default;">You have 0 activities to do...</li>
                @endif
                <!-- <a href="#" class="list-group-item text-center" data-toggle="modal" data-target="#create-todo-modal" style="padding: 6px;">Show All To Do</a> -->
            </div>
        </div><!--col 4-->
    </div><!--row-->

    <!-- Create ToDo Modal -->
    <form action="{{ route('admin.todo.store') }}" method="POST" class="modal fade in" tabindex="-1" role="dialog" id="create-todo-modal">
        {{ csrf_field() }}

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-edit"></i> Create To Do Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="row mt-4 mb-4">
                        <div class="col">
                            <div class="form-group row">
                                <label for="title" class="col-md-3 form-control-label">Title</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="title" required maxlength="30">
                                </div><!--col-->
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="description" class="col-md-3 form-control-label">Description</label>

                                <div class="col-md-9">
                                    <textarea class="form-control" name="description" required></textarea>
                                </div><!--col-->
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="priority_level" class="col-md-3 form-control-label">Priority Level</label>

                                <div class="col-md-9">
                                    <select name="priority_level" id="priority_level" class="custom-select">
                                        <option value="high">High Priority</option>
                                        <option value="low">Low Priority</option>
                                    </select>
                                </div><!--col-->
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                </div><!-- modal-body -->

                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Create</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
@endsection
