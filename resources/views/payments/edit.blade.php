{{ Form::model($payment, array('route' => array('payments.update', $payment->id), 'method' => 'PUT','enctype' => "multipart/form-data")) }}
<div class="form-group">
    {{ Form::label('name', __('Payment Name')) }}
    {{ Form::text('name', null, array('class' => 'form-control font-style','required'=>'required')) }}
    @error('name')
    <span class="invalid-name" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Update'),array('class'=>'btn btn-primary'))}}
</div>
{{ Form::close() }}



