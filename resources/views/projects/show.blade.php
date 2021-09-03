@extends('layouts.admin')
@php
    $profile=asset(Storage::url('avatar/'));
@endphp
@push('css-page')
    <link href="{{ asset('assets/css/dropzone.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/basic.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@push('script-page')
    <script src="{{ asset('assets/js/dropzone.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/form-dropzone.min.js') }}" type="text/javascript"></script>
    <script>
        var count = document.getElementById('testID').innerHTML.split(' ').length;
        var html = $("#testID").html();
        var remain = html.substring(count);
        if (count > 100) {
            html = html.substring(0, 500) + '<a id="read-more-btn"  onclick="read_more()" >Read more</a> <p id="read_more">' + remain + '</p>';

        }
        $("#testID").html(html);
        $('#read_more').hide();

        function read_more() {

            var x = document.getElementById("read_more");
            if (x.style.display === "none") {
                x.style.display = "block";
                $('#read-more-btn').css('display', 'none');
            } else {
                x.style.display = "none";
                $('#read-more-btn').css('display', 'block');
            }
        }


        var Select2 = (function () {
            var $select = $('.custom-select');

            function init($this) {
                var options = {
                    dropdownParent: $this.closest('.modal').length ? $this.closest('.modal') : $(document.body),
                    // minimumResultsForSearch: $this.data('minimum-results-for-search'),
                    // templateResult: formatAvatar
                    minimumResultsForSearch: -1
                };
                $this.select2(options);
            }

            if ($select.length) {
                $select.each(function () {
                    init($(this));
                });
            }
        })();


    </script>

@endpush
@section('page-title')
    Job Detail
@endsection
@section('content')
    @php
        $permissions=$project->client_project_permission();
        $perArr=(!empty($permissions)? explode(',',$permissions->permissions):[]);
        $project_last_stage = ($project->project_last_stage($project->id))? $project->project_last_stage($project->id)->id:'';

        $total_task = $project->project_total_task($project->id);
        $completed_task=$project->project_complete_task($project->id,$project_last_stage);

         $percentage=0;
            if($total_task!=0){
                $percentage = intval(($completed_task / $total_task) * 100);
            }


        $label='';
        if($percentage<=15){
            $label='bg-danger';
        }else if ($percentage > 15 && $percentage <= 33) {
            $label='bg-warning';
        } else if ($percentage > 33 && $percentage <= 70) {
            $label='bg-primary';
        } else {
            $label='bg-success';
        }
    @endphp
    <section class="section">
        <div class="section-header">
            <h1>Job Detail</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item active"><a href="{{route('projects.index')}}">{{__('Project')}}</a></div>
                <div class="breadcrumb-item font-style">{{$project->name}}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card project-intro project">
                        <div class="card-header d-flex align-items-center">
                            <h4 class="font-style">{{$project->name}}</h4>
                            <div class="card-header-action">
                                <div class="btn-group">
                                        <!-- @can('manage bug report')
                                            <a href="{{ route('task.bug',$project->id) }}" class="btn btn-outline-primary btn-sm mr-10">
                                                <span class="btn-inner--icon"><i class="fas fa-bug"></i></span>
                                                <span class="btn-inner--text">{{__('Bug Report')}}</span>
                                            </a>
                                        @endcan
                                        @can('manage timesheet')
                                            <a href="{{ route('task.timesheetRecord',$project->id) }}" class="btn btn-outline-primary btn-sm mr-10">
                                                <span class="btn-inner--icon"><i class="fas fa-calendar"></i></span>
                                                <span class="btn-inner--text">{{__('Time Sheet')}}</span>
                                            </a>
                                        @endcan -->
                                    @can('manage task')
                                        <!-- @if(\Auth::user()->type!='client' || (\Auth::user()->type=='client' && in_array('show task',$perArr)))
                                            <a href="{{ route('project.taskboard',$project->id) }}" class="btn btn-outline-primary btn-sm mr-10">
                                                <span class="btn-inner--icon"><i class="fas fa-tasks"></i></span>
                                                <span class="btn-inner--text">{{__('Task Kanban')}}</span>
                                            </a>
                                        @endif -->
                                    @endcan
                                    @can('edit project')

                                        <a class="btn btn-outline-primary btn-sm mr-10" data-url="{{ route('projects.edit',$project->id) }}" data-ajax-popup="true" data-title="{{__('Add User')}}" href="#">
                                            <span class="btn-inner--icon"><i class="fas fa-user-edit"></i></span>
                                            <span class="btn-inner--text">{{__('Edit')}}</span>
                                        </a>
                                    @endcan
                                    @can('delete task')
                                        <a href="#" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$project->id}}').submit();" class="btn btn-outline-danger btn-sm">
                                            <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
                                            <span class="btn-inner--text">{{__('Delete')}}</span>
                                        </a>

                                        {!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id],'id'=>'delete-form-'.$project->id]) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <p id="testID" class="card-text font-style">
                                        {{ $project->description }}
                                    </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="project-intro mb-3 d-flex">
                                        <div class="Date start-date mr-3">
                                            <p class="m-0">{{__('Start Date')}}</p>
                                            <div class="badges">
                                                <span class="badge badge-light">{{ \Auth::user()->dateFormat($project->start_date) }}</span>
                                            </div>
                                        </div>
                                        <div class="Date due-date mr-3">
                                            <p class="m-0">{{__('Due Date')}}</p>
                                            <div class="badges">
                                                <span class="badge badge-light">{{ \Auth::user()->dateFormat($project->due_date) }} </span>
                                            </div>
                                        </div>
                                        <div class="progress-wrap">
                                            <p class="m-0">{{__('Progress')}}</p>
                                            <div class="progress">
                                                <div class="progress-bar bg-low" style="width:{{$percentage}}%">{{$percentage}}%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @php
                                    $datetime1 = new DateTime($project->due_date);
                                    $datetime2 = new DateTime(date('Y-m-d'));
                                    $interval = $datetime1->diff($datetime2);
                                    $days = $interval->format('%a')
                                @endphp
                                <div class="col-lg-12">
                                    <ul>
                                        <li>
                                            <div class="project-highlight">
                                                <i class="fas fa-university"></i>
                                                <div class="info">
                                                    <span>{{__('Budget')}}</span>
                                                    <p class="value">{{ \Auth::user()->priceFormat($project->price) }}0</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="project-highlight">
                                                <i class="fas fa-star"></i>
                                                <div class="info">
                                                    <span>{{__('Expense')}}</span>
                                                    <p class="value">{{ \Auth::user()->priceFormat($project->project_expenses()) }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="project-highlight">
                                                <i class="fas fa-clipboard"></i>
                                                <div class="info">
                                                    <span>{{__('Tasks')}}</span>
                                                    <p class="value">{{$project->countTask()}}</p>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="project-highlight">
                                                <i class="fas fa-comment"></i>
                                                <div class="info">
                                                    <span>{{__('Comments')}}</span>
                                                    <p class="value">{{$project->countTaskComments()}}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="project-highlight">
                                                <i class="fas fa-users"></i>
                                                <div class="info">
                                                    <span>{{__('Members')}}</span>
                                                    <p class="value">{{$project->project_user()->count()}}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="project-highlight">
                                                <i class="fas fa-calendar-alt"></i>
                                                <div class="info">
                                                    <span>{{__('Days Left')}}</span>
                                                    <p class="value">{{$days}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="custom-table-view">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{__('Staff')}}</h4>
                                @can('invite user project')
                                    <div class="card-header-action">
                                        <a href="#" data-url="{{ route('project.invite',$project->id) }}" data-ajax-popup="true" data-title="{{__('Add User')}}" class="btn btn-primary btn-sm">
                                            {{__('Add User')}}
                                        </a>
                                    </div>
                                @endcan
                            </div>
                            <div class="card-body">
                                <div class="custom-table-inner">
                                    <div class="table-row d-flex">
                                        <div class="user-name">
                                            <a class="font-style" href="#">{{(!empty($project->client())?$project->client()->name:'')}}</a>
                                            <span>{{(!empty($project->client())?$project->client()->email:'')}}</span>
                                        </div>
                                        <div class="task px-1">

                                        </div>
                                        <div class="tag px-1">
                                            <span>{{__('Client')}}</span>
                                        </div>
                                        <div class="status">
                                            @can('client permission project')
                                                <a href="" data-toggle="modal" data-url="{{ route('client.permission',[$project->id,$project->client]) }}" data-ajax-popup="true" data-title="{{__('Client Permission')}}" data-toggle="tooltip" data-original-title="{{__('Client Permission')}}"><i class="fas fa-lock"></i> </a>
                                            @endcan
                                        </div>
                                    </div>
                                    @foreach($project->project_user() as $user)
                                        @php $totalTask= $project->user_project_total_task($user->project_id,$user->user_id) @endphp
                                        @php $completeTask= $project->user_project_comlete_task($user->project_id,$user->user_id,($project->project_last_stage())?$project->project_last_stage()->id:'' ) @endphp

                                        <div class="table-row d-flex">
                                            <div class="user-name">
                                                <a class="font-style" href="#">{{$user->name}}</a>
                                                <span>{{$user->email}}</span>
                                            </div>
                                            <div class="task px-1">
                                                <span>{{$completeTask.'/'.$totalTask}}</span>
                                            </div>
                                            <div class="tag px-1">
                                                <span>{{$user->type}}</span>
                                            </div>
                                            <div class="status">

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- @if(\Auth::user()->type!='client' || (\Auth::user()->type=='client' && in_array('show milestone',$perArr)))
                            <div class="custom-table-view">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{__('Milestones')}} ({{count($project->milestones)}})</h4>
                                        @if(\Auth::user()->type!='client' || (\Auth::user()->type=='client' && in_array('create milestone',$perArr)))
                                            <div class="card-header-action">
                                                <a href="#" data-url="{{ route('project.milestone',$project->id) }}" data-ajax-popup="true" data-title="{{__('Create New Milestone')}}" class="btn btn-primary btn-sm">
                                                    {{__('Create Milestone')}}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div class="custom-table-inner milestones">
                                            @foreach($project->milestones as $milestone)
                                                <div class="table-row d-flex">
                                                    <div class="milestones-name">
                                                        <a class="font-style" href="#" data-ajax-popup="true" data-title="{{ __('Milestones Details') }}" data-url="{{route('project.milestone.show',[$milestone->id])}}">{{$milestone->title}}</a>
                                                        <span>{{$milestone->created_at}}</span>
                                                    </div>
                                                    <div class="milestones px-1">
                                                        <b>{{__('Milestone Cost')}}</b>
                                                        <span>$ {{number_format($milestone->cost)}}</span>
                                                    </div>
                                                    <div class="tag px-1">
                                                        <span>
                                                            {{$milestone->status}}
                                                        </span>
                                                    </div>
                                                    <div class="action">
                                                        @if(\Auth::user()->type!='client' || (\Auth::user()->type=='client' && in_array('edit milestone',$perArr)))
                                                            <a href="#" data-url="{{ route('project.milestone.edit',$milestone->id) }}" data-ajax-popup="true" data-title="Edit Milestone" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="far fa-edit"></i></a>
                                                        @endif
                                                        @if(\Auth::user()->type!='client' || (\Auth::user()->type=='client' && in_array('delete milestone',$perArr)))
                                                            <a href="" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$milestone->id}}').submit();"><i class="far fa-trash-alt"></i></a>

                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['project.milestone.destroy', $milestone->id],'id'=>'delete-form-'.$milestone->id]) !!}
                                                            {!! Form::close() !!}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif -->
                    <div class="col-lg-12">
                        <div class="card todo-ui">
                            <div class="card-body">
                                <form action="#" class="dropzone dropzone-file-area" id="my-dropzone" style="">
                                    <h3 class="sbold">{{__('Drop files here or click to upload')}}</h3>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">

                    <div class="card project-status">
                        <div class="card-header">
                            <h4>{{__('Project Status')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ Form::model($project, array('route' => array('projects.update.status', $project->id), 'method' => 'PUT')) }}
                            <div class="d-flex">
                                <div class="form-group m-0">
                                    <select class="form-control" name="status" id="status">
                                        <option value="">{{__('Select Project Status')}}</option>
                                        @foreach($project_status as $key => $value)
                                            <option value="{{ $key }}" {{ ($project->status == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{Form::submit(__('Change Job Status'),array('class'=>'ml-1 btn btn-danger btn-sm d-flex align-items-center'))}}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Activity')}}</h4>

                        </div>
                        <div class="card-body">

                            <ul class="list-unstyled list-unstyled-border activity-wrap">
                                @foreach($project->activities as $activity)
                                    <li class="">
                                        <h6 class="m-0">{{$activity->log_type}}</h6>
                                        <p class="m-0">{!! $activity->remark !!}</p>
                                        <div><i class="far fa-calendar-alt"></i><span class="ml-1"> {{date('d M Y H:i', strtotime($activity->created_at))}}  </span></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@push('script-page')
    <script>

        Dropzone.autoDiscover = false;
        myDropzone = new Dropzone("#my-dropzone", {
            maxFiles: 20,
            maxFilesize: 2,
            parallelUploads: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt",
            url: "{{route('project.file.upload',[$project->id])}}",
            success: function (file, response) {
                if (response.is_success) {
                    dropzoneBtn(file, response);
                } else {
                    myDropzone.removeFile(file);
                    toastrs('Error', response.error, 'error');
                }
            },
            error: function (file, response) {
                myDropzone.removeFile(file);
                if (response.error) {
                    toastrs('Error', response.error, 'error');
                } else {
                    toastrs('Error', response.error, 'error');
                }
            }
        });
        myDropzone.on("sending", function (file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("project_id", {{$project->id}});
        });

        function dropzoneBtn(file, response) {
            var download = document.createElement('a');
            download.setAttribute('href', response.download);
            download.setAttribute('class', "btn btn-outline-primary btn-sm");
            download.setAttribute('data-toggle', "tooltip");
            download.setAttribute('data-original-title', "{{__('Download')}}");
            download.innerHTML = "<i class='fas fa-download'></i>";

            var del = document.createElement('a');
            del.setAttribute('href', response.delete);
            del.setAttribute('class', "btn btn-outline-danger btn-sm trigger--fire-modal-1");
            del.setAttribute('data-toggle', "tooltip");
            del.setAttribute('data-original-title', "{{__('Delete')}}");
            del.innerHTML = "<i class='fas fa-trash'></i>";

            del.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (confirm("Are you sure ?")) {
                    var btn = $(this);
                    $.ajax({
                        url: btn.attr('href'),
                        data: {_token: $('meta[name="csrf-token"]').attr('content')},
                        type: 'DELETE',
                        success: function (response) {
                            if (response.is_success) {
                                btn.closest('.dz-image-preview').remove();
                            } else {
                                toastrs('Error', response.error, 'error');
                            }
                        },
                        error: function (response) {
                            response = response.responseJSON;
                            if (response.is_success) {
                                toastrs('Error', response.error, 'error');
                            } else {
                                toastrs('Error', response.error, 'error');
                            }
                        }
                    })
                }
            });

            var html = document.createElement('div');
            html.setAttribute('class', "text-center mt-10");
            html.appendChild(download);
            html.appendChild(del);

            file.previewTemplate.appendChild(html);
        }

            @php
                $files = $project->files;

            @endphp
            @foreach($files as $file)
        var mockFile = {name: "{{$file->file_name}}", size: {{filesize(storage_path('app/public/project_files/'.$file->file_path))}} };
        myDropzone.emit("addedfile", mockFile);
        {{--myDropzone.emit("thumbnail", mockFile, "{{asset('storage/project_files/'.$file->file_path)}}");--}}
        myDropzone.emit("thumbnail", mockFile, "{{asset('storage/app/public/project_files/'.$file->file_path)}}");
        myDropzone.emit("complete", mockFile);
        dropzoneBtn(mockFile, {download: "{{route('projects.file.download',[$project->id,$file->id])}}", delete: "{{route('projects.file.delete',[$project->id,$file->id])}}"});
        @endforeach


    </script>
@endpush

