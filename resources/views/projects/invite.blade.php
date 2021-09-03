{{ Form::open(array('route' => array('invite',$project_id))) }}
<div class="row">
    <div class="form-group col-md-12">
        {{ Form::label('user', __('User')) }}
        {!! Form::select('user[]', $employee, null,array('class' => 'form-control selectric','required'=>'required')) !!}
        @error('client')
        <span class="invalid-user" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
        {{Form::submit(__('Add'),array('class'=>'btn btn-primary'))}}
    </div>
</div>

{{ Form::close() }}
