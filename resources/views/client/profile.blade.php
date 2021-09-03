@extends('layouts.main')
@section('content')
@php
    $profile=asset(Storage::url('avatar/'));
@endphp
<section class="section">
    <div class="section-header">
        <h1 class="d-inline">{{__('Profile')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item">{{__('Profile')}}</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Hi, {{$userDetail->name}}!</h2>
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="{{$profile.'/'.$userDetail->avatar}}" class="rounded-circle profile-widget-picture" width="100px" height="100px" onerror="this.onerror=null;this.src='{{$profile.'/avatar.png'}}'">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">{{__('Posts')}}</div>
                                <div class="profile-widget-item-value">187</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">{{__('Followers')}}</div>
                                <div class="profile-widget-item-value">6,8K</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">{{__('Following')}}</div>
                                <div class="profile-widget-item-value">2,1K</div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="profile-widget-name">
                            {{$userDetail->name}}
                            <div class="text-muted d-inline font-weight-normal">
                                <div class="slash">

                                </div>{{$userDetail->type}}</div>
                        </div>
                        {{$userDetail->email}}
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                        <div class="card-header">
                            <h4>{{__('Edit Profile')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{Form::model($userDetail,array('route' => array('update.account'), 'method' => 'put', 'enctype' => "multipart/form-data"))}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            {{Form::label('name',__('Name'))}}
                                            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>_('Enter User Name')))}}
                                            @error('name')
                                            <span class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            {{Form::label('email',__('Email'))}}
                                            {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email')))}}
                                            @error('email')
                                            <span class="invalid-email" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            {{Form::label('profile',__('Profile'))}}
                                            {{Form::file('profile',array('class'=>'form-control'))}}
                                            @error('profile')
                                            <span class="invalid-profile" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <img alt="image" src="{{$profile.'/'.$userDetail->avatar}}" onerror="this.onerror=null;this.src='{{$profile.'/avatar.png'}}'" class="rounded-circle profile-widget-picture" width="50px" height="50px">
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <a href="{{ route('dashboard') }}" class="btn btn-outline btn-sm red" >{{__('Cancel')}}</a>
                                        {{Form::submit('Save Changes',array('class'=>'btn btn-outline btn-sm blue-madison'))}}
                                    </div>
                            </div>
                                {{Form::close()}}
                        </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
<script>

</script>
