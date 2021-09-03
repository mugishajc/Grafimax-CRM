{{ Form::model($invoice, array('route' => array('invoices.payments.store', $invoice->id), 'method' => 'POST')) }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('amount', __('Amount')) }}
            {{ Form::number('amount', $invoice->getDue(), array('class' => 'form-control','required'=>'required','min'=>'0',"step"=>"0.01")) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('date', __('Payment Date')) }}
            {{ Form::text('date', null, array('class' => 'form-control datepicker','required'=>'required')) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('payment_id', __('Payment Method')) }}
            {{ Form::select('payment_id', $payment_methods,null, array('class' => 'form-control font-style selectric','required'=>'required')) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('notes', __('Notes')) }}
            {{ Form::textarea('notes', null, array('class' => 'form-control','rows'=>'2')) }}
        </div>
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
        {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
    </div>
</div>

{{ Form::close() }}
