@extends('layouts.admin')
@php
    $profile=asset(Storage::url('avatar/'));
@endphp
@section('page-title')
    {{__('Time Sheet')}}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Time Sheet')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item"><a href="{{route('projects.index')}}">{{__('Project')}}</a></div>
                <div class="breadcrumb-item font-style"><a href="{{ route('projects.show',$project->id) }}">{{$project->name}}</a></div>
                <div class="breadcrumb-item">{{__('Time Sheet')}}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4>{{__('Manage Time Sheet')}}</h4>
                            @can('manage timesheet')
                                <a href="#" data-url="{{ route('task.timesheet',$project->id) }}" data-ajax-popup="true" data-title="{{__('Create Time Sheet')}}" data-toggle="tooltip" data-original-title="{{__('Create Time Sheet')}}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-plus"></i> {{__('Create')}}
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="dataTable">
                                <thead>
                                <tr>
                                    <th> {{__('Task')}}</th>
                                    <th> {{__('Date')}}</th>
                                    <th> {{__('Hours')}}</th>
                                    <th> {{__('Remark')}}</th>
                                    @if(\Auth::user()->type!='client')
                                        <th class=" text-right" width="200px"> {{__('Action')}}</th>
                                    @else
                                        <th>{{__('User')}}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($timeSheets as $timeSheet)

                                    <tr>
                                        <td class="font-style">{{ !empty($timeSheet->task())? $timeSheet->task()->title : ''}}</td>
                                        <td>{{ Auth::user()->dateFormat($timeSheet->date) }}</td>
                                        <td>{{ $timeSheet->hours }}</td>
                                        <td class="font-style">{{ $timeSheet->remark }}</td>
                                        @if(\Auth::user()->type!='client')
                                            <td class="action text-right">
                                                <a href="#" data-url="{{ route('task.timesheet.edit',[$project->id,$timeSheet->id]) }}" data-ajax-popup="true" data-title="{{__('Edit Time Sheet')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <a href="#" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$timeSheet->id}}').submit();">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['task.timesheet.destroy', $project->id,$timeSheet->id],'id'=>'delete-form-'.$timeSheet->id]) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        @else
                                            <td>{{$timeSheet->user()->name}}</td>
                                        @endif

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
