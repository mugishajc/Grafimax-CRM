{{ Form::open(array('url' => 'bugstatus')) }}
<div class="form-group">
    {{ Form::label('title', __('Bug Status Title')) }}
    {{ Form::text('title', '', array('class' => 'form-control','required'=>'required')) }}
    @error('title')
    <span class="invalid-title" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
</div>
{{ Form::close() }}
