@extends('layouts.admin')
@push('script-page')
@endpush
@php
    $dir= asset(Storage::url('plan'));
@endphp
@section('page-title')
    {{__('Note')}}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Note')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('Note')}}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4>{{__('Manage Note')}}</h4>

                            @can('create note')
                                <a href="#" class="btn btn-sm btn-warning" data-url="{{ route('notes.create') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Create Note')}}">
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
                                @foreach($notes as $note)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="staff staff-grid-view font-style">
                                            <div class="custom-control custom-radio  mb-3 {{$note->color}} ">
                                                <label class="custom-control-label "></label>
                                                {{$note->title}}
                                            </div>
                                            <p>{{$note->text}}</p>

                                            <div class="date mb-3">
                                                <b>{{\Auth::user()->dateFormat($note->created_at)}}</b>
                                            </div>
                                            <div class="btn-wrap">
                                                @can('edit note')
                                                    <a href="#!" class="btn" data-url="{{ route('notes.edit',$note->id) }}" data-ajax-popup="true" data-title="{{__('Edit Note')}}" title="Edit">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete note')
                                                    <button class="btn  trigger--fire-modal-1" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$note->id}}').submit();" title="Delete" class="btn">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['notes.destroy', $note->id],'id'=>'delete-form-'.$note->id]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
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
    </section>
@endsection
