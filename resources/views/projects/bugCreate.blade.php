{{ Form::open(array('route' => array('task.bug.store',$project_id))) }}
<div class="row">
    <div class="form-group col-md-6">
        {{ Form::label('title', __('Title')) }}
        {{ Form::text('title', '', array('class' => 'form-control','required'=>'required')) }}
        @error('title')
        <span class="invalid-title" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('priority', __('Priority')) }}
        {!! Form::select('priority', $priority, null,array('class' => 'form-control font-style selectric','required'=>'required')) !!}
        @error('priority')
        <span class="invalid-priority" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('status', __('Bug Status')) }}
        {!! Form::select('status', $status, null,array('class' => 'form-control font-style selectric','required'=>'required')) !!}
        @error('status')
        <span class="invalid-status" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('assign_to', __('Assigned To')) }}
        {{ Form::select('assign_to', $users, null,array('class' => 'form-control selectric','required'=>'required')) }}
        @error('assign_to')
        <span class="invalid-assign_to" role="alert">
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
