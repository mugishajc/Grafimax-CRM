@extends('layouts.admin')
@php
    $profile=asset(Storage::url('avatar/'));
@endphp
@section('page-title')
    {{__('Bug Report')}}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Bug Report')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item"><a href="{{route('projects.index')}}">{{__('Project')}}</a></div>
                <div class="breadcrumb-item font-style"><a href="{{ route('projects.show',$project->id) }}">{{$project->name}}</a></div>
                <div class="breadcrumb-item">{{__('Bug Report')}}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4>{{__('Manage Bug Report')}}</h4>
                            @can('manage bug report')
                                <a href="{{ route('task.bug.kanban',$project->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-bug"></i> {{__('Bug Kanban')}}
                                </a>
                            @endcan

                        </div>
                        @can('create bug report')
                            <a href="#" data-url="{{ route('task.bug.create',$project->id) }}" data-ajax-popup="true" data-title="{{__('Create Bug')}}" data-toggle="tooltip" data-original-title="{{__('Create Bug')}}" class="btn btn-sm btn-warning ml-10">
                                <i class="fa fa-plus"></i> {{__('Create')}}
                            </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="dataTable">
                                <thead>
                                <tr>
                                    <th> {{__('Bug Id')}}</th>
                                    <th> {{__('Assign To')}}</th>
                                    <th> {{__('Bug Title')}}</th>
                                    <th> {{__('Status')}}</th>
                                    <th> {{__('Priority')}}</th>
                                    <th> {{__('Description')}}</th>
                                    <th> {{__('Created By')}}</th>
                                    <th> {{__('Date')}}</th>
                                    <th class="text-right" width="200px"> {{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($bugs as $bug)
                                    <tr>
                                        <td>{{ \Auth::user()->bugNumberFormat($bug->bug_id)}}</td>
                                        <td>{{ $bug->assignTo->name }}</td>
                                        <td>{{ $bug->title}}</td>
                                        <td>{{ $bug->bug_status->title }}</td>
                                        <td>{{ $bug->priority }}</td>
                                        <td>{{ $bug->description }}</td>
                                        <td>{{ $bug->createdBy->name }}</td>
                                        <td>{{ Auth::user()->dateFormat($bug->created_at) }}</td>
                                        <td class="action text-right">
                                            @can('edit bug report')
                                                <a href="#" data-url="{{ route('task.bug.edit',[$project->id,$bug->id]) }}" data-ajax-popup="true" data-title="{{__('Edit Bug Report')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('delete bug report')
                                                    <a href="#" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$bug->id}}').submit();">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['task.bug.destroy', $project->id,$bug->id],'id'=>'delete-form-'.$bug->id]) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
