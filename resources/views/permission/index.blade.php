@extends('layouts.admin')
@push('css-page')
@endpush
@push('script-page')
@endpush
@section('breadcrumb')
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{ route('dashboard') }}">{{__('Home')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>{{__('Permissions')}}</span>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit portlet-datatable ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">{{__('Permission')}}</span>
                    </div>
                    @can('create permission')
                        <span class="create-btn">
                            <a href="#" data-url="{{ route('permissions.create') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Create New Permission')}}" class="btn btn-circle btn-outline btn-sm blue-madison">
                                <i class="fa fa-plus"></i> &nbsp;&nbsp;{{__('Create')}}
                            </a>
                        </span>
                    @endcan
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th> {{__('Permissions')}}</th>
                                <th class="text-right" width="200px"> {{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td class="action">
                                        @can('create permission')
                                            <a href="#" data-url="{{ route('permissions.edit',$permission->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Update permission')}}" class="btn btn-outline btn-sm blue-madison">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('create permission')
                                            <a href="#" class="btn btn-outline btn-sm red" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$permission->id}}').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id],'id'=>'delete-form-'.$permission->id]) !!}
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
@endsection
