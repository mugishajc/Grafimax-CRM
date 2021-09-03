@extends('layouts.admin')

@section('page-title')
    {{__('Invoice')}}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Invoice')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('Invoice')}}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between w-100">
                                <h4>{{__('Manage Invoice')}}</h4>
                                @can('create invoice')
                                    <a href="#" data-url="{{ route('invoices.create') }}" data-ajax-popup="true" data-title="{{__('Create Invoice')}}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-plus"></i> {{__('Create')}}
                                    </a>
                                @endcan
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
                                                        <th> {{__('Invoice')}}</th>
                                                        <th> Job</th>
                                                        <th> {{__('Issue Date')}}</th>
                                                        <th> {{__('Due Date')}}</th>
                                                        <th> {{__('Value')}}</th>
                                                        <th> {{__('Status')}}</th>
                                                        @if(Gate::check('edit invoice') || Gate::check('delete invoice'))
                                                            <th> {{__('Action')}}</th>
                                                        @endif
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach ($invoices as $invoice)
                                                        <tr>

                                                            <td>
                                                                <a href="{{ route('invoices.show',$invoice->id) }}" class="btn btn-outline-primary btn-sm">{{ AUth::user()->invoiceNumberFormat($invoice->id) }}</a>
                                                            </td>
                                                            <td>{{ (isset($invoice->project) && !empty($invoice->project)) ? $invoice->project->name : '-' }}</td>
                                                            <td>{{ Auth::user()->dateFormat($invoice->issue_date) }}</td>
                                                            <td>{{ Auth::user()->dateFormat($invoice->due_date) }}</td>
                                                            <td>{{ Auth::user()->priceFormat($invoice->getTotal()) }}</td>
                                                            <td>
                                                                @if($invoice->status == 0)
                                                                    <span class="label label-soft-primary">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                                                @elseif($invoice->status == 1)
                                                                    <span class="label label-soft-danger">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                                                @elseif($invoice->status == 2)
                                                                    <span class="label label-soft-warning">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                                                @elseif($invoice->status == 3)
                                                                    <span class="label label-soft-success">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                                                @elseif($invoice->status == 4)
                                                                    <span class="label label-soft-info">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                                                @endif
                                                            </td>
                                                            @if(Gate::check('edit invoice') || Gate::check('delete invoice'))
                                                                <td class="action">
                                                                    @can('show invoice')
                                                                        <a href="{{ route('invoices.show',$invoice->id) }}" data-toggle="tooltip" data-original-title="{{__('Detail')}}">
                                                                            <i class="far fa-eye"></i>
                                                                        </a>
                                                                    @endcan
                                                                    @can('edit invoice')
                                                                        <a href="#!" data-url="{{ route('invoices.edit',$invoice->id) }}" data-ajax-popup="true" data-title="{{__('Edit Invoice')}}" class="btn btn-outline btn-sm blue-madison" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>
                                                                    @endcan
                                                                    @can('delete invoice')
                                                                        <a href="#!" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$invoice->id}}').submit();">
                                                                            <i class="far fa-trash-alt"></i>
                                                                        </a>
                                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['invoices.destroy', $invoice->id],'id'=>'delete-form-'.$invoice->id]) !!}
                                                                        {!! Form::close() !!}
                                                                    @endcan
                                                                </td>
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
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
