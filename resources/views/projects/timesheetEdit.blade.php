{{ Form::model($timeSheet, array('route' => array('task.timesheet.update', $project_id,$timeSheet->id), 'method' => 'PUT')) }}
<div class="row">
    <div class="form-group col-md-6">
        {{ Form::label('task_id', __('Task')) }}
        {!! Form::select('task_id', $tasks, null,array('class' => 'form-control font-style selectric','required'=>'required')) !!}
        @error('task_id')
        <span class="invalid-task_id" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('date', __('Task Date')) }}
        {{ Form::text('date', null, array('class' => 'form-control datepicker','required'=>'required')) }}
        @error('date')
        <span class="invalid-date" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('hours', __('Task Hours')) }}
        {{ Form::number('hours', null, array('class' => 'form-control','required'=>'required')) }}
        @error('hours')
        <span class="invalid-hours" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="form-group  col-md-12">
        {{ Form::label('remark', __('Remark')) }}
        {!! Form::textarea('remark', null, ['class'=>'form-control','rows'=>'2']) !!}
        @error('remark')
        <span class="invalid-remark" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
        {{Form::submit(__('Update'),array('class'=>'btn btn-primary'))}}
    </div>
</div>

{{ Form::close() }}
