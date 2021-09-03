@extends('layouts.admin')
@push('script-page')
@endpush
@php
    $dir= asset(Storage::url('plan'));
@endphp
@section('page-title')
    {{__('Plan')}}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Plan')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('Plan')}}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4>{{__('Manage Plan')}}</h4>
                            @can('create plan')
                                <a href="#" class="btn btn-sm btn-warning" data-url="{{ route('plans.create') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Create New Plan')}}">
                                  <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.861 49.861"><path d="M45.963 21.035h-17.14V3.896C28.824 1.745 27.08 0 24.928 0s-3.896 1.744-3.896 3.896v17.14H3.895C1.744 21.035 0 22.78 0 24.93s1.743 3.895 3.895 3.895h17.14v17.14c0 2.15 1.744 3.896 3.896 3.896s3.896-1.744 3.896-3.896v-17.14h17.14c2.152 0 3.896-1.744 3.896-3.895a3.9 3.9 0 0 0-3.898-3.896z" fill="#010002"/></svg>
                                  </span>
                                    {{__('Create')}}
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="staff-wrap">
                            <div class="row">
                                @foreach($plans as $plan)
                                    <div class="col-12 col-md-3 col-lg-3">
                                        <div class="pricing">
                                            <div class="pricing-title">
                                                {{$plan->name}}
                                            </div>
                                            <div class="flex mt-3">
                                                @if(!empty($plan->image))
                                                    <img class="plan-img" src="{{$dir.'/'.$plan->image}}">
                                                @endif
                                            </div>
                                            <div class="pricing-padding">
                                                <div class="pricing-price">
                                                    <div> ${{$plan->price}}</div>
                                                    <div>{{$plan->duration}}</div>
                                                </div>
                                                <div class="pricing-details">
                                                    <div class="pricing-item">
                                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                                        <div class="pricing-item-label">{{$plan->max_users}} {{__('Users')}}</div>
                                                    </div>
                                                    <div class="pricing-item">
                                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                                        <div class="pricing-item-label">{{$plan->max_clients}} {{__('Clients')}}</div>
                                                    </div>
                                                    <div class="pricing-item">
                                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                                        <div class="pricing-item-label">{{$plan->max_projects}} {{__('Projects')}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing-cta">
                                                @can('edit plan')
                                                    <a href="#" data-url="{{ route('plans.edit',$plan->id) }}" data-ajax-popup="true" data-title="{{__('Edit Plan')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="far fa-edit"></i></a>
                                                @endcan
                                                @can('buy plan')
                                                    @if($plan->id!=\Auth::user()->plan)
                                                        <a href="{{route('stripe',\Illuminate\Support\Facades\Crypt::encrypt($plan->id))}}"><i class="fa fa-cart-plus"></i></a>
                                                    @endif
                                                @endcan
                                                @if(\Auth::user()->type=='company' && \Auth::user()->plan == $plan->id)
                                                    <div class="text-center">
                                                        <a class="view-btn">
                                                            {{__('Active')}}
                                                        </a>
                                                    </div>
                                                @endif
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
    </section>
@endsection
