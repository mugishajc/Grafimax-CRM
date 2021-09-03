@extends('layouts.admin')
@push('script-page')
@endpush
@php
    $dir= asset(Storage::url('plan'));
@endphp
@section('page-title')
Job
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Job</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">Job</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4>Manage Jobs</h4>

                                <a href="#" class="btn btn-sm btn-warning" data-url="{{ route('jobs.create') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Create Job')}}">
                                  <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.861 49.861"><path d="M45.963 21.035h-17.14V3.896C28.824 1.745 27.08 0 24.928 0s-3.896 1.744-3.896 3.896v17.14H3.895C1.744 21.035 0 22.78 0 24.93s1.743 3.895 3.895 3.895h17.14v17.14c0 2.15 1.744 3.896 3.896 3.896s3.896-1.744 3.896-3.896v-17.14h17.14c2.152 0 3.896-1.744 3.896-3.895a3.9 3.9 0 0 0-3.898-3.896z" fill="#010002"/></svg>
                                  </span>
                                    {{__('Create')}}
                                </a>

                        </div>
                    </div>
                    body here 


                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
