{{ Form::open(array('route' => array('project.milestone.store',$project->id))) }}
<div class="row">
    <div class="form-group  col-md-6">
        {{ Form::label('title', __('Title')) }}
        {{ Form::text('title', '', array('class' => 'form-control','required'=>'required')) }}
        @error('title')
        <span class="invalid-title" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    <div class="form-group  col-md-6">
        {{ Form::label('status', __('Status')) }}
        {!! Form::select('status', $status, null,array('class' => 'form-control selectric','required'=>'required')) !!}
        @error('client')
        <span class="invalid-client" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group  col-md-12">
        {{ Form::label('cost', __('Cost')) }}
        {{ Form::number('cost', '', array('class' => 'form-control','required'=>'required')) }}
        @error('cost')
        <span class="invalid-cost" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="form-group  col-md-12">
        {{ Form::label('description', __('Description')) }}
        {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']) !!}
        @error('description')
        <span class="invalid-description" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
        {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
    </div>
</div>
{{ Form::close() }}
