{{ Form::open(array('url' => 'expensescategory')) }}
<div class="form-group">
    {{ Form::label('name', __('Expenses Category Name')) }}
    {{ Form::text('name', '', array('class' => 'form-control','required'=>'required')) }}
    @error('name')
    <span class="invalid-name" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
</div>
{{ Form::close() }}
