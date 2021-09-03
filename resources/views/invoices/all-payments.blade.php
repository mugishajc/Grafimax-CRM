@extends('layouts.admin')

@section('page-title')
    {{__('Payment')}}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Payment')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('Payment')}}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between w-100">
                                <h4>{{__('Manage Payment')}}</h4>
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

                                                        <th> {{__('Transaction ID')}}</th>
                                                        <th> {{__('Invoice')}}</th>
                                                        <th> {{__('Payment Date')}}</th>
                                                        <th> {{__('Payment Method')}}</th>
                                                        <th> {{__('Note')}}</th>
                                                        <th> {{__('Amount')}}</th>
                                                        @if(Gate::check('show invoice') || \Auth::user()->type=='client')
                                                            <th>{{__('Action')}}</th>
                                                        @endif
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach($payments as $payment)
                                                        <tr>
                                                            <td>
                                                                {{sprintf("%05d", $payment->transaction_id)}}
                                                            </td>
                                                            <td>
                                                                {{ Auth::user()->invoiceNumberFormat($payment->invoice->invoice_id) }}
                                                            </td>
                                                            <td>
                                                                {{ Auth::user()->dateFormat($payment->date) }}
                                                            </td>
                                                            <td>
                                                                {{(!empty($payment->payment)?$payment->payment->name:'')}}
                                                            </td>
                                                            <td class="td-style">
                                                                {{$payment->notes}}
                                                            </td>
                                                            <td>
                                                                {{Auth::user()->priceFormat($payment->amount)}}
                                                            </td>
                                                            @if(Gate::check('show invoice') || \Auth::user()->type=='client')
                                                                <td>
                                                                    <a href="{{ route('invoices.show',$payment->invoice->id) }}" class="table-action" data-toggle="tooltip" data-original-title="{{__('Invoice Detail')}}">
                                                                        <i class="fas fa-eye"></i>
                                                                    </a>
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
