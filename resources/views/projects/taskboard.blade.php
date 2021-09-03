@extends('layouts.admin')
@php
    $profile=asset(Storage::url('avatar/'));
@endphp
@push('script-page')

    <script src="{{asset('assets/js/dragula.min.js')}}"></script>

    <script>
        @can('move task')
            @if(\Auth::user()->type!='client' || (\Auth::user()->type=='client' && in_array('move task',$perArr)))

            !function (a) {
            "use strict";
            var t = function () {
                this.$body = a("body")
            };
            t.prototype.init = function () {
                a('[data-plugin="dragula"]').each(function () {
                    var t = a(this).data("containers"), n = [];
                    if (t) for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]); else n = [a(this)[0]];
                    var r = a(this).data("handleclass");
                    r ? dragula(n, {
                        moves: function (a, t, n) {
                            return n.classList.contains(r)
                        }
                    }) : dragula(n).on('drop', function (el, target, source, sibling) {

                        var order = [];
                        $("#" + target.id + " > div").each(function () {
                            order[$(this).index()] = $(this).attr('data-id');
                        });

                        var id = $(el).attr('data-id');
                        var stage_id = $(target).attr('data-id');

                        $("#" + source.id).parent().find('.count').text($("#" + source.id + " > div").length);
                        $("#" + target.id).parent().find('.count').text($("#" + target.id + " > div").length);

                        $.ajax({
                            url: '{{route('taskboard.order')}}',
                            type: 'POST',
                            data: {task_id: id, stage_id: stage_id, order: order, "_token": $('meta[name="csrf-token"]').attr('content')},
                            success: function (data) {
                                toastrs('Success', 'task successfully updated', 'success');
                            },
                            error: function (data) {
                                data = data.responseJSON;
                                toastrs('Error', data.error, 'error')
                            }
                        });
                    });
                })
            }, a.Dragula = new t, a.Dragula.Constructor = t
        }(window.jQuery), function (a) {
            "use strict";

            a.Dragula.init()

        }(window.jQuery);
        @endif
        @endcan
    </script>
    <script>
        $(document).on('click', '#form-comment button', function (e) {
            var comment = $.trim($("#form-comment textarea[name='comment']").val());
            var name = '{{\Auth::user()->name}}';
            if (comment != '') {
                $.ajax({
                    url: $("#form-comment").data('action'),
                    data: {comment: comment, "_token": $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);

                        var html = "<li class='media mb-20'>" +
                            "                    <div class='media-body'>" +
                            "                        <h5 class='mt-0'>" + name + "</h5>" +
                            "                        " + data.comment +
                            "                           <div class='comment-trash' style=\"float: right\">" +
                            "                               <a href='#' class='btn btn-outline btn-sm red text-muted  delete-comment' data-url='" + data.deleteUrl + "' >" +
                            "                                   <i class='far fa-trash-alt'></i>" +
                            "                               </a>" +

                            "                           </div>" +
                            "                    </div>" +
                            "                </li>";


                        $("#comments").prepend(html);
                        $("#form-comment textarea[name='comment']").val('');
                        toastrs('Success', '{{ __("Comment Added Successfully!")}}', 'success');
                    },
                    error: function (data) {
                        toastrs('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                    }
                });
            } else {
                toastrs('Error', '{{ __("Please write comment!")}}', 'error');
            }
        });

        $(document).on("click", ".delete-comment", function () {
            if (confirm('Are You Sure ?')) {
                var btn = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'JSON',
                    success: function (data) {
                        toastrs('Success', '{{ __("Comment Deleted Successfully!")}}', 'success');
                        btn.closest('.media').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            toastrs('Error', data.message, 'error');
                        } else {
                            toastrs('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                        }
                    }
                });
            }
        });

        $(document).on('submit', '#form-file', function (e) {
            e.preventDefault();
            $.ajax({
                url: $("#form-file").data('url'),
                type: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    toastrs('Success', '{{ __("Comment Added Successfully!")}}', 'success');
                    // console.log(data);
                    var delLink = '';

                    if (data.deleteUrl.length > 0) {
                        delLink = "<a href='#' class='text-danger text-muted delete-comment-file'  data-url='" + data.deleteUrl + "'>" +
                            "                                        <i class='dripicons-trash'></i>" +
                            "                                    </a>";
                    }

                    var html = '<li class="media mb-20">\n' +
                        '                                                <div class="media-body">\n' +
                        '                                                    <h5 class="mt-0 mb-1 font-weight-bold"> ' + data.name + '</h5>\n' +
                        '                                                   ' + data.file_size + '' +
                        '                                                    <div class="comment-trash" style="float: right">\n' +
                        '                                                        <a download href="{{asset('storage/tasks/')}}' + data.file + '" class="btn btn-outline btn-sm blue-madison">\n' +
                        '                                                            <i class="fa fa-download"></i>\n' +
                        '                                                        </a>' +
                        '<a href=\'#\' class="btn btn-outline btn-sm red text-muted delete-comment"  data-url="' + data.deleteUrl + '"><i class="far fa-trash-alt"></i></a>' +

                        '                                                    </div>\n' +
                        '                                                </div>\n' +
                        '                                            </li>';
                    $("#comments-file").prepend(html);
                },
                error: function (data) {
                    data = data.responseJSON;
                    if (data.message) {
                        toastrs('Error', data.message, 'error');
                        $('#file-error').text(data.errors.file[0]).show();
                    } else {
                        toastrs('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                    }
                }
            });
        });

        $(document).on("click", ".delete-comment-file", function () {

            if (confirm('Are You Sure ?')) {
                var btn = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'JSON',
                    success: function (data) {
                        toastrs('Success', '{{ __("File Deleted Successfully!")}}', 'success');
                        btn.closest('.media').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            toastrs('Error', data.message, 'error');
                        } else {
                            toastrs('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                        }
                    }
                });
            }
        });

        $(document).on('submit', '#form-checklist', function (e) {
            e.preventDefault();

            $.ajax({
                url: $("#form-checklist").data('action'),
                type: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    toastrs('Success', '{{ __("Checklist Added Successfully!")}}', 'success');

                    var html = '<li class="media">' +
                        '<div class="media-body">' +
                        '<h5 class="mt-0 mb-1 font-weight-bold"> </h5> ' +
                        '<div class=" custom-control custom-checkbox checklist-checkbox"> ' +
                        '<input type="checkbox" id="checklist-' + data.id + '" class="custom-control-input"  data-url="' + data.updateUrl + '">' +
                        '<label for="checklist-' + data.id + '" class="custom-control-label"></label> ' +
                        '' + data.name + ' </div>' +
                        '<div class="comment-trash" style="float: right"> ' +
                        '<a href="#" class="btn btn-outline btn-sm red text-muted delete-checklist" data-url="' + data.deleteUrl + '">\n' +
                        '                                                            <i class="far fa-trash-alt"></i>' +
                        '</a>' +
                        '</div>' +
                        '</div>' +
                        ' </li>';


                    $("#check-list").prepend(html);
                    $("#form-checklist input[name=name]").val('');
                    $("#form-checklist").collapse('toggle');
                },
            });
        });

        $(document).on("click", ".delete-checklist", function () {
            if (confirm('Are You Sure ?')) {
                var btn = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'JSON',
                    success: function (data) {
                        toastrs('Success', '{{ __("Checklist Deleted Successfully!")}}', 'success');
                        btn.closest('.media').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            toastrs('Error', data.message, 'error');
                        } else {
                            toastrs('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                        }
                    }
                });
            }
        });

        var checked = 0;
        var count = 0;
        var percentage = 0;

        $(document).on("change", "#check-list input[type=checkbox]", function () {
            $.ajax({
                url: $(this).attr('data-url'),
                type: 'PUT',
                data: {_token: $('meta[name="csrf-token"]').attr('content')},
                // dataType: 'JSON',
                success: function (data) {
                    toastrs('Success', '{{ __("Checklist Updated Successfully!")}}', 'success');
                    // console.log(data);
                },
                error: function (data) {
                    data = data.responseJSON;
                    toastrs('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                }
            });
            taskCheckbox();
        });
    </script>
@endpush

@section('page-title')
    {{__('Task')}}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Task')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item active"><a href="{{route('projects.index')}}">{{__('Project')}}</a></div>
                <div class="breadcrumb-item active font-style"><a href="{{ route('projects.show',$project->id) }}">{{$project->name}}</a></div>
                <div class="breadcrumb-item">{{__('Task')}}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4>{{__('Manage Task')}}</h4>
                            @can('create task')
                                <span class="create-btn">
                                        <a href="#" data-url="{{ route('task.create',$project->id) }}" data-ajax-popup="true" data-title="{{__('Add New Task')}}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-plus"></i> &nbsp;&nbsp; {{__('Create')}}
                                    </a>
                                    </span>
                            @endcan
                        </div>
                    </div>
                    @php
                        $json = [];
                        foreach ($stages as $stage){
                            $json[] = 'lead-list-'.$stage->id;
                        }
                    @endphp

                    <div class="board" data-plugin="dragula" data-containers='{!! json_encode($json) !!}'>
                        <div class="card-body">
                            <div class="lead-wrap">
                                <div class="row">
                                    <div class="custom-scroll-horizontal">
                                        @foreach($stages as $stage)
                                            @if(\Auth::user()->type =='client' || \Auth::user()->type =='company')
                                                @php $tasks =$stage->tasks($project->id) @endphp
                                            @else
                                                @php $tasks =$stage->tasks($project->id)     @endphp
                                            @endif
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="lead-grp">
                                                    <div class="lead-grp-title font-style">{{$stage->name}} ({{ count($tasks) }})</div>

                                                    <div id="lead-list-{{$stage->id}}" data-id="{{$stage->id}}" class="custom-scroll">
                                                        @foreach($tasks as $task)
                                                            <div class="lead lead-grid-view" data-id="{{$task->id}}">

                                                                @if(Gate::check('edit task') || Gate::check('delete task'))

                                                                    <div class="more-action">
                                                                        <div class="dropdown">
                                                                            <a href="" class="btn dropdown-toggle" data-toggle="dropdown">
                                                                                <svg width="18" height="4" viewBox="0 0 18 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M1.13672 0.804688C1.42318 0.518229 1.7526 0.375 2.125 0.375C2.4974 0.375 2.8125 0.518229 3.07031 0.804688C3.35677 1.0625 3.5 1.3776 3.5 1.75C3.5 2.1224 3.35677 2.45182 3.07031 2.73828C2.8125 2.99609 2.4974 3.125 2.125 3.125C1.7526 3.125 1.42318 2.99609 1.13672 2.73828C0.878906 2.45182 0.75 2.1224 0.75 1.75C0.75 1.3776 0.878906 1.0625 1.13672 0.804688ZM8.01172 0.804688C8.29818 0.518229 8.6276 0.375 9 0.375C9.3724 0.375 9.6875 0.518229 9.94531 0.804688C10.2318 1.0625 10.375 1.3776 10.375 1.75C10.375 2.1224 10.2318 2.45182 9.94531 2.73828C9.6875 2.99609 9.3724 3.125 9 3.125C8.6276 3.125 8.29818 2.99609 8.01172 2.73828C7.75391 2.45182 7.625 2.1224 7.625 1.75C7.625 1.3776 7.75391 1.0625 8.01172 0.804688ZM14.8867 0.804688C15.1732 0.518229 15.5026 0.375 15.875 0.375C16.2474 0.375 16.5625 0.518229 16.8203 0.804688C17.1068 1.0625 17.25 1.3776 17.25 1.75C17.25 2.1224 17.1068 2.45182 16.8203 2.73828C16.5625 2.99609 16.2474 3.125 15.875 3.125C15.5026 3.125 15.1732 2.99609 14.8867 2.73828C14.6289 2.45182 14.5 2.1224 14.5 1.75C14.5 1.3776 14.6289 1.0625 14.8867 0.804688Z"
                                                                                        fill="#778CA2"></path>
                                                                                </svg>
                                                                            </a>

                                                                            <div class="dropdown-menu">
                                                                                @can('edit task')
                                                                                    <a href="#" data-url="{{ route('task.edit',$task->id) }}" data-ajax-popup="true" data-title="{{__('Edit Task')}}" data-original-title="{{__('Edit')}}" class="dropdown-item">
                                                                                        {{__('Edit')}}
                                                                                    </a>
                                                                                @endcan

                                                                                @can('delete task')
                                                                                    <a class="dropdown-item" href="#" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$task->id}}').submit();">{{__('Delete')}}</a>
                                                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['task.destroy', $task->id],'id'=>'delete-form-'.$task->id]) !!}
                                                                                    {!! Form::close() !!}
                                                                                @endcan
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                <div class="title mb-1">
                                                                    <a href="#" data-url="{{ route('task.show',$task->id) }}" data-ajax-popup="true" data-title="{{__('Task Board')}}" class="dropdown-item p-0 task-inner-title font-style">{{$task->title}}</a>
                                                                    <span class="task-status low">
                                                                        @if($task->priority =='low')
                                                                            <div class="label label-soft-success"> {{ $task->priority }}</div>
                                                                        @elseif($task->priority =='medium')
                                                                            <div class="label label-soft-warning"> {{ $task->priority }}</div>
                                                                        @elseif($task->priority =='high')
                                                                            <div class="label label-soft-danger"> {{ $task->priority }}</div>
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                                <div class="meta-info mb-1">
                                                                    <p> {{$task->description}}
                                                                    </p>
                                                                    <div class="task-progress @if($task->taskCompleteCheckListCount()==$task->taskTotalCheckListCount() && $task->taskCompleteCheckListCount()!=0) label-soft-success @else label-soft-warning @endif ">
                                                                        <span class="">   {{$task->taskCompleteCheckListCount()}}/{{$task->taskTotalCheckListCount()}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="footer-wrap">
                                                                    <div class="date">
                                                                        <i class="far fa-clock"></i>
                                                                        <span class="pl-1">{{ \Auth::user()->dateFormat($task->start_date) }} </span>
                                                                    </div>

                                                                    <div class="avatar">
                                                                        <a href="#" class="avatar avatar-xs" data-toggle="tooltip" title="" data-original-title="{{(!empty($task->task_user)?$task->task_user->name:'')}}">
                                                                            <img src="{{(!empty($task->task_user->avatar)?$profile.'/'.$task->task_user->avatar:$profile.'/avatar.png')}}" class="avatar-img rounded-circle">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
