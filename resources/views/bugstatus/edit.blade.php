{{ Form::model($bugStatus, array('route' => array('bugstatus.update', $bugStatus->id), 'method' => 'PUT')) }}
<div class="form-group">
    {{ Form::label('title', __('Bug Status Title')) }}
    {{ Form::text('title',null, array('class' => 'form-control','required'=>'required')) }}
    @error('title')
    <span class="invalid-title" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Update'),array('class'=>'btn btn-primary'))}}
</div>
{{ Form::close() }}



