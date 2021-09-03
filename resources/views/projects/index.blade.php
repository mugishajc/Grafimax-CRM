@extends('layouts.admin')
@push('script-page')

@endpush
@php
    $profile=asset(Storage::url('avatar/'));
@endphp
@section('page-title')
    Job
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Jobs</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">Job</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title section-title-custome">
                @can('create lead')
                    <a href="{{ route('projects.create') }}"   data-title="{{__('Create New Job')}}" class="btn btn-sm btn-warning create-btn">
                        <i class="fa fa-plus"></i> &nbsp;&nbsp;New Job
                    </a>
                @endcan
            </h2>
            <div class="row">
                @foreach ($projects as $project)
                    @php
                        $permissions=$project->client_project_permission();
                        $perArr=(!empty($permissions)? explode(',',$permissions->permissions):[]);

                        $project_last_stage = ($project->project_last_stage($project->id)? $project->project_last_stage($project->id)->id:'');

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
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card project">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div>
                                    @if($project->is_active==1)
                                        <a href="{{ route('projects.show',$project->id) }}" class="text-dark">
                                            @endif
                                            <h4 class="font-style"> {{ $project->name }} - Job N<sup>0</sup>{{$project->id}}</h4>
                                            @if($project->is_active==1)
                                        </a>
                                    @endif
                                    @foreach($project_status as $key => $status)
                                        @if($key== $project->status)
                                            @if($status=='Completed')
                                                @php $status_color ='badge-success' @endphp
                                            @elseif($status=='On Going')
                                                @php $status_color ='badge-primary' @endphp
                                            @else
                                                @php $status_color ='badge-warning' @endphp
                                            @endif
                                            <div class="badge {{$status_color}}">
                                                {{ $status}}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="card-header-action">
                                    <div class="more-action">
                                        <div class="dropdown">
                                            @if($project->is_active==1)
                                                <a href="" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    <svg width="18" height="4" viewBox="0 0 18 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1.13672 0.804688C1.42318 0.518229 1.7526 0.375 2.125 0.375C2.4974 0.375 2.8125 0.518229 3.07031 0.804688C3.35677 1.0625 3.5 1.3776 3.5 1.75C3.5 2.1224 3.35677 2.45182 3.07031 2.73828C2.8125 2.99609 2.4974 3.125 2.125 3.125C1.7526 3.125 1.42318 2.99609 1.13672 2.73828C0.878906 2.45182 0.75 2.1224 0.75 1.75C0.75 1.3776 0.878906 1.0625 1.13672 0.804688ZM8.01172 0.804688C8.29818 0.518229 8.6276 0.375 9 0.375C9.3724 0.375 9.6875 0.518229 9.94531 0.804688C10.2318 1.0625 10.375 1.3776 10.375 1.75C10.375 2.1224 10.2318 2.45182 9.94531 2.73828C9.6875 2.99609 9.3724 3.125 9 3.125C8.6276 3.125 8.29818 2.99609 8.01172 2.73828C7.75391 2.45182 7.625 2.1224 7.625 1.75C7.625 1.3776 7.75391 1.0625 8.01172 0.804688ZM14.8867 0.804688C15.1732 0.518229 15.5026 0.375 15.875 0.375C16.2474 0.375 16.5625 0.518229 16.8203 0.804688C17.1068 1.0625 17.25 1.3776 17.25 1.75C17.25 2.1224 17.1068 2.45182 16.8203 2.73828C16.5625 2.99609 16.2474 3.125 15.875 3.125C15.5026 3.125 15.1732 2.99609 14.8867 2.73828C14.6289 2.45182 14.5 2.1224 14.5 1.75C14.5 1.3776 14.6289 1.0625 14.8867 0.804688Z"
                                                            fill="#778CA2"></path>
                                                    </svg>
                                                </a>
                                            @else
                                                <i class="fas fa-lock"></i>
                                            @endif
                                            <div class="dropdown-menu">
                                                @can('edit project')
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-url="{{ route('projects.edit',$project->id) }}" data-ajax-popup="true" data-title="{{__('Edit Project')}}">
                                                            <span>{{__('Edit')}}</span>
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('delete project')
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$project->id}}').submit();">
                                                            <span>{{__('Delete')}}</span>
                                                        </a>
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id],'id'=>'delete-form-'.$project->id]) !!}
                                                        {!! Form::close() !!}
                                                    </li>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="project-intro mb-3 d-flex">
                                    <div class="Date start-date mr-3">
                                        <p class="m-0">{{__('Start Date')}}</p>
                                        <div class="badges">
                                            <span class="badge badge-light">{{ \Auth::user()->dateFormat($project->start_date) }} </span>
                                        </div>
                                    </div>
                                    <div class="Date due-date mr-3">
                                        <p class="m-0">{{__('Due Date')}}</p>
                                        <div class="badges">
                                            <span class="badge badge-light">{{ \Auth::user()->dateFormat($project->due_date) }} </span>
                                        </div>
                                    </div>
                                    <div class="progress-wrap">
                                        <p class="m-0"> {{__('Progress')}}</p>
                                        <div class="progress">
                                            <div class="progress-bar bg-low" style="width:{{$percentage}}%">{{$percentage}}%</div>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text font-style">
                                    {{ $project->description }}
                                </p>
                                <div class="project-info d-flex">
                                    <div class="project-info-inner mr-3">
                                        <p class="m-0"> {{__('Budget')}} </p>
                                        <div class="project-amnt">{{ \Auth::user()->priceFormat($project->price) }}</div>
                                    </div>
                                    <div class="project-info-inner mr-3">
                                        <p class="m-0"> {{__('Expencese')}} </p>
                                        <div class="project-amnt">{{ \Auth::user()->priceFormat($project->project_expenses()) }}</div>
                                    </div>
                                    @php
                                        $client=(!empty($project->client())?$project->client()->avatar:'')
                                    @endphp
                                    <div class="project-info-inner mr-4">
                                        <p class="m-0"> {{__('Client')}} </p>
                                        <div class="project-amnt"><img width="30" src="{{(!empty($client)? $profile.'/'.$client:$profile.'/avatar.png')}}" alt="" class="wd-30 rounded-circle mg-l--10" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{(!empty($project->client())?$project->client()->name:'')}}"></div>
                                    </div>
                                    <div class="project-members">
                                        <p class="m-0"> {{__('Members')}} </p>
                                        <ul class="users list-unstyled d-flex align-items-center justify-content-center">
                                            @foreach($project->project_user() as $project_user)
                                                <a href="#" class="d-block mr-1 mb-1">
                                                    <img width="30" src="{{(!empty($project_user->avatar)? $profile.'/'.$project_user->avatar:$profile.'/avatar.png')}}" class="wd-30 rounded-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{(!empty($project_user)?$project_user->name:'')}}">
                                                </a>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="footer-action">
                                        <a href="#" class="card-link">
                                            <i class="fas fa-tasks"></i>
                                            @if($project->is_active==1)
                                                <a href="{{ route('project.taskboard',$project->id) }}" class="custom-widget__value custom-font-brand">{{$project->countTask()}} {{__('Tasks')}}</a>
                                            @else
                                                <a href="#" class="custom-widget__value custom-font-brand">{{$project->countTask()}} {{__('Tasks')}}</a>
                                            @endif

                                        </a>
                                        <a href="#" class="card-link">
                                            <i class="far fa-comments"></i>
                                            @if($project->is_active==1)
                                                <a href="{{ route('project.taskboard',$project->id) }}" class="custom-widget__value custom-font-brand">{{$project->countTaskComments()}} {{__('Comments')}} </a>
                                            @else
                                                <a href="#" class="custom-widget__value custom-font-brand">{{$project->countTaskComments()}} {{__('Comments')}} </a>
                                            @endif
                                        </a>
                                    </div>
                                    @if($project->is_active==1)
                                        <a href="{{ route('projects.show',$project->id) }}" class="btn btn-primary">{{__('Detail')}}</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
