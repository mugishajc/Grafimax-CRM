@extends('layouts.admin')

@section('page-title')
    {{__('Lead')}}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Lead')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('Lead')}}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between w-100">
                                <h4>{{__('Manage Lead')}}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body p-0">
                                <div id="table-1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                    <div class="table-responsive">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-flush" id="dataTable">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th> {{__('Name')}}</th>
                                                        <th> {{__('Price')}}</th>
                                                        <th>{{__('User Assign')}} </th>
                                                        <th>{{__('Stage')}} </th>
                                                        <th>{{__('Notes')}} </th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach ($leads as $lead)
                                                        <tr>
                                                            <td>{{ $lead->name }}</td>
                                                            <td>{{ $lead->price }}</td>
                                                            <td>{{ $lead->user()->name }}</td>
                                                            <td>{{ $lead->stage_name }}</td>
                                                            <td>{{ $lead->notes }}</td>
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
                </div>
            </div>

        </div>
    </section>
@endsection
