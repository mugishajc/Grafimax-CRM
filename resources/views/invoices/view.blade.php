@extends('layouts.admin')

@section('page-title')
    {{__('Invoice Detail')}}
@endsection
@push('script-page')
    <script>
        function getTask(obj, project_id) {
            $('#task_id').empty();
            var milestone_id = obj.value;
            $.ajax({
                url: '{!! route('invoices.milestone.task') !!}',
                data: {
                    "milestone_id": milestone_id,
                    "project_id": project_id,
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                success: function (data) {
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].title + '</option>';

                    }
                    $('#task_id').append(html);
                },
                error: function (data) {
                    data = data.responseJSON;
                    toastrs('Error', data.error, 'error')
                }
            });
        }

        function hide_show(obj) {
            if (obj.value == 'milestone') {
                document.getElementById('milestone').style.display = 'block';
                document.getElementById('other').style.display = 'none';
            } else {
                document.getElementById('other').style.display = 'block';
                document.getElementById('milestone').style.display = 'none';
            }
        }

    </script>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Invoice Detail')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('invoices.index') }}">{{__('Invoice')}}</a></div>
                <div class="breadcrumb-item">{{__('Invoice Detail')}}</div>
            </div>
        </div>

        <div class="section-body card">
            <div class="card-header d-flex align-items-center">
                <h4>{{__('Invoices')}}</h4>
                <div class="card-header-action">
                    <div class="btn-group">
                        @can('create invoice product')
                            <a href="#" class="btn btn-sm btn-warning" data-url="{{ route('invoices.products.add',$invoice->id) }}" data-ajax-popup="true" data-title="{{__('Add Item')}}">
                                <span><i class="fas fa-plus"></i></span>
                                {{__('Add Item')}}
                            </a>
                        @endcan
                        @can('create invoice payment')
                            <a href="#" class="btn btn-sm btn-warning mx-2" data-url="{{ route('invoices.payments.create',$invoice->id) }}" data-ajax-popup="true" data-title="{{__('Add Payment')}}">
                                <span><i class="fas fa-plus"></i></span>
                                {{__('Add Payment')}}
                            </a>
                        @endcan
                        @can('edit invoice')
                            <a href="#" class="btn btn-sm btn-warning" data-url="{{ route('invoices.edit',$invoice->id) }}" data-ajax-popup="true" data-title="{{__('Edit Invoice')}}" data-original-title="{{__('Edit')}}">
                                <span><i class="far fa-edit"></i></span>
                                {{__('Edit Invoice')}}
                            </a>
                        @endcan
                        @can('manage invoice')
                            <a href="{{ route('get.invoice',$invoice->id) }}" class="btn btn-sm btn-warning ml-2" download title="{{__('Download Invoice')}}">
                                <span><i class="fa fa-file-download"></i></span>
                            </a>
                            <a href="{{ route('get.invoice',$invoice->id) }}" class="btn btn-sm btn-warning ml-2" title="{{__('Print Invoice')}}" target="_blanks">
                                <span><i class="fa fa-print"></i></span>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-right mb-10">
                                <h5>{{ Auth::user()->invoiceNumberFormat($invoice->id) }}</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>{{__('Billed To')}} : </strong><br>
                                        {{$settings['company_name']}}<br>
                                        {{$settings['company_address']}}<br>
                                        {{$settings['company_city']}}, {{$settings['company_state']}}-{{$settings['company_zipcode']}}<br>
                                        {{$settings['company_country']}}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>{{__('Shipped To')}}:</strong><br>
                                        {{(!empty($user))?$user->name:''}}<br>
                                        {{(!empty($user))?$user->email:''}}<br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <address>
                                        <strong>{{__('Status')}}:</strong><br>
                                        <div class="font-weight-bold font-style">
                                            @if($invoice->status == 0)
                                                <span class="badge badge-primary">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                            @elseif($invoice->status == 1)
                                                <span class="badge badge-danger">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                            @elseif($invoice->status == 2)
                                                <span class="badge badge-warning">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                            @elseif($invoice->status == 3)
                                                <span class="badge badge-success">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                            @elseif($invoice->status == 4)
                                                <span class="badge badge-info">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                            @endif
                                        </div>
                                    </address>
                                </div>
                                @if(!empty($invoice->project))
                                    <div class="col-md-3 text-md-center">
                                        <strong>{{__('Project')}}:</strong><br>
                                        {{ $invoice->project->name }}<br><br>
                                    </div>
                                @endif
                                <div class="col-md-3 text-md-center">
                                    <strong>{{__('Issue Date')}}:</strong><br>
                                    {{ Auth::user()->dateFormat($invoice->issue_date) }}<br>
                                </div>
                                <div class="col-md-3 text-md-right">
                                    <strong>{{__('Due Date')}}:</strong><br>
                                    {{ Auth::user()->dateFormat($invoice->due_date) }}<br><br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-md-12">
                            <div class="section-title">{{__('Order Summary')}}
                                <div class="col-md-12 text-right">
                                    @can('create invoice product')
                                        <a href="#" class="btn btn-sm btn-warning" data-url="{{ route('invoices.products.add',$invoice->id) }}" data-ajax-popup="true" data-title="{{__('Add Item')}}">
                                            <span><i class="fas fa-plus"></i></span>
                                            {{__('Add')}}
                                        </a>
                                    @endcan
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th class="text-center">{{__('Item')}}</th>
                                        <th class="text-center">{{__('Price')}}</th>
                                        <th class="text-right">{{__('Action')}}</th>

                                    </tr>
                                    @php $i=0; @endphp

                                    @foreach($invoice->items as $items)
                                        <tr>
                                            <td>
                                                {{++$i}}
                                            </td>
                                            <td class="text-center font-style">
                                                {{$items->iteam}}
                                            </td>
                                            <td class="text-center">
                                                {{Auth::user()->priceFormat($items->price)}}
                                            </td>
                                            <td class="table-actions text-right">
                                                @can('delete invoice product')
                                                    <a href="#" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$items->id}}').submit();">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['invoices.products.delete', $invoice->id,$items->id],'id'=>'delete-form-'.$items->id]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @php
                            $subTotal = $invoice->getSubTotal();
                         $tax = $invoice->getTax();
                        @endphp
                        <div class="col-md-2">
                            <div class="invoice-detail-name"><b>{{__('Subtotal')}}</b></div>
                            <div class="invoice-detail-value"> {{Auth::user()->priceFormat($subTotal)}}</div>
                        </div>
                        <div class="col-md-2 text-md-center">
                            <div class="invoice-detail-name"><b>{{__('Discount')}}</b></div>
                            <div class="invoice-detail-value"> {{Auth::user()->priceFormat($invoice->discount)}}</div>
                        </div>

                        <div class="col-md-3 text-md-center">
                            <div class="invoice-detail-name"><b>{{(!empty($invoice->tax)?$invoice->tax->name:'Tax')}} ({{(!empty($invoice->tax->rate)?$invoice->tax->rate:'0')}} %)</b></div>
                            <div class="invoice-detail-value"> {{Auth::user()->priceFormat($tax)}}</div>
                        </div>
                        <div class="col-md-3 text-md-center">
                            <div class="invoice-detail-name"><b>{{__('Total')}}</b></div>
                            <div class="invoice-detail-value">{{Auth::user()->priceFormat($subTotal-$invoice->discount+$tax)}}</div>
                        </div>
                        <div class="col-md-2 text-md-right">
                            <div class="invoice-detail-name"><b>{{__('Due Amount')}}</b></div>
                            <div class="invoice-detail-value"> {{Auth::user()->priceFormat($invoice->getDue())}}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="section-title">
                                {{__('Payment History')}}
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th>{{__('Transaction ID')}}</th>
                                        <th class="text-center">{{__('Payment Date')}}</th>
                                        <th class="text-center">{{__('Payment Method')}}</th>
                                        <th class="text-center">{{__('Note')}}</th>
                                        <th class="text-right">{{__('Amount')}}</th>
                                    </tr>
                                    @php $i=0; @endphp
                                    @foreach($invoice->payments as $payment)
                                        <tr>
                                            <td>
                                                {{sprintf("%05d", $payment->transaction_id)}}
                                            </td>
                                            <td class="text-center">
                                                {{ Auth::user()->dateFormat($payment->date) }}
                                            </td>
                                            <td class="text-center">
                                                {{(!empty($payment->payment)?$payment->payment->name:'')}}
                                            </td>
                                            <td class="text-center">
                                                {{$payment->notes}}
                                            </td>
                                            <td class="text-right">
                                                {{Auth::user()->priceFormat($payment->amount)}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>

                        </div>
                    </div>
                    {{--                    <div class="text-md-right">--}}
                    {{--                        <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </section>
@endsection
