@extends('layouts.admin')
@section('page-title')
    {{__('Product Unit')}}
@endsection
@push('script-page')
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Inventory Unit</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">Inventory</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4>Manage Inventory Unit</h4>
                            @can('create product unit')
                                <a href="#" class="btn btn-sm btn-warning" data-url="{{ route('productunits.create') }}" data-ajax-popup="true" data-title="Create new stock">
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
                                        {{--  <div class="constant-table">
                                            <table class="table table-striped">
                                                <thead class="">
                                                <tr>
                                                    <th scope="col" style="width: 60%;"></th>
                                                    <th scope="col" style="width: 20%;"></th>
                                                    <th scope="col" style="width: 10%;"></th>
                                                </tr>
                                                </thead>
                                                <tbody  class="">
                                                @foreach ($productunits as $productunit)
                                                    <tr data-id="{{$productunit->id}}">
                                                        <td>
                                                            <a>{{$productunit->name}}</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">{{$productunit->created_at}}</span>
                                                        </td>
                                                        <td class="table-actions">
                                                            @can('edit product unit')
                                                                <a href="#" class="table-action" data-url="{{ route('productunits.edit',$productunit->id) }}" data-ajax-popup="true" data-title="{{__('Edit Lead Source')}}" class="table-action" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="far fa-edit"></i></a>
                                                            @endcan
                                                            @can('delete product unit')
                                                                <a href="#" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$productunit->id}}').submit();"><i class="far fa-trash-alt"></i></a>
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['productunits.destroy', $productunit->id],'id'=>'delete-form-'.$productunit->id]) !!}
                                                                {!! Form::close() !!}
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>  --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
