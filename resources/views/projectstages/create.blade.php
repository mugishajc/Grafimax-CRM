{{ Form::open(array('url' => 'projectstages')) }}
<div class="form-group">
    {{ Form::label('name', __('Project Stage Name')) }}
    {{ Form::text('name', '', array('class' => 'form-control','required'=>'required')) }}
    @error('name')
    <span class="invalid-name" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    {{ Form::label('color', __('Color')) }}
    <input class="jscolor form-control" value="FFFFFF" name="color" id="color" required>
    <small class="small">{{ __('For chart representation') }}</small>
</div>
<div class="form-group text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
</div>

{{ Form::close() }}
