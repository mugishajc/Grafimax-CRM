@extends('layouts.admin')
@section('page-title')
    {{__('Lead Stage')}}
@endsection
@push('script-page')
    <script>
        $(function () {
            $(".sortable").sortable();
            $(".sortable").disableSelection();
            $(".sortable").sortable({

                stop: function () {
                    var order = [];
                    $(this).find('tr').each(function (index, data) {
                        order[index] = $(data).attr('data-id');
                    });
                    $.ajax({
                        url: "{{route('leadstages.order')}}",
                        data: {order: order, _token: $('meta[name="csrf-token"]').attr('content')},
                        type: 'POST',
                        success: function (data) {
                            toastrs('Success', 'Lead Stage successfully updated', 'success');
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            toastrs('Error', data.error, 'error')
                        }
                    })
                }
            });
        });
    </script>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Lead Stage')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('Lead Stage')}}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4>{{__('Manage Lead Stages')}}</h4>
                            @can('create lead stage')
                                <a href="#" class="btn btn-sm btn-warning" data-url="{{ route('leadstages.create') }}" data-ajax-popup="true" data-title="{{__('Create New Lead Stage')}}">
                                  <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.861 49.861">
                                        <path d="M45.963 21.035h-17.14V3.896C28.824 1.745 27.08 0 24.928 0s-3.896 1.744-3.896 3.896v17.14H3.895C1.744 21.035 0 22.78 0 24.93s1.743 3.895 3.895 3.895h17.14v17.14c0 2.15 1.744 3.896 3.896 3.896s3.896-1.744 3.896-3.896v-17.14h17.14c2.152 0 3.896-1.744 3.896-3.895a3.9 3.9 0 0 0-3.898-3.896z" fill="#010002"></path></svg>
                                  </span>
                                    {{__('Create')}}
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="constant-table">
                                            <table class="table table-striped">
                                                <thead class="">
                                                    <tr>
                                                        <th scope="col" style="width: 60%;"></th>
                                                        <th scope="col" style="width: 20%;"></th>
                                                        <th scope="col" style="width: 10%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody  class="sortable">
                                                @foreach ($leadstages as $leadstage)
                                                    <tr data-id="{{$leadstage->id}}">
                                                        <td>
                                                            <a>{{$leadstage->name}}</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">{{$leadstage->created_at}}</span>
                                                        </td>
                                                        <td class="table-actions">
                                                            @can('edit lead stage')
                                                                <a href="#" class="table-action" data-url="{{ route('leadstages.edit',$leadstage->id) }}" data-ajax-popup="true" data-title="{{__('Edit Lead Stages')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="far fa-edit"></i></a>
                                                            @endcan
                                                            @can('delete lead stage')
                                                                <a href="#" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$leadstage->id}}').submit();"><i class="far fa-trash-alt"></i></a>
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['leadstages.destroy', $leadstage->id],'id'=>'delete-form-'.$leadstage->id]) !!}
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
                    </div>
                </div>
                <div class="alert alert-info note-constant">
                    <strong>{{__('Note')}} :</strong> {{__('System will consider last stage as a completed / done leads.')}}
                </div>
            </div>
        </div>
    </section>
@endsection
