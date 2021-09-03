{{ Form::model($project, array('route' => array('projects.update', $project->id), 'method' => 'PUT')) }}
<div class="row">
    <div class="form-group  col-md-6">
        {{ Form::label('name', __('Projects Name')) }}
        {{ Form::text('name', null, array('class' => 'form-control font-style','required'=>'required')) }}
        @error('name')
        <span class="invalid-name" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    <div class="form-group  col-md-6">
        {{ Form::label('price', __('Projects Price')) }}
        {{ Form::number('price', null, array('class' => 'form-control','required'=>'required')) }}
        @error('price')
        <span class="invalid-price" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    <div class="form-group  col-md-6">
        {{ Form::label('date', __('Due Date')) }}
        {{ Form::text('date', $project->due_date, array('class' => 'form-control datepicker','required'=>'required')) }}
        @error('date')
        <span class="invalid-date" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group  col-md-6">
        {{ Form::label('client', __('Client')) }}
        {!! Form::select('client', $clients, null,array('class' => 'form-control font-style selectric','required'=>'required')) !!}
        @error('client')
        <span class="invalid-client" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group col-md-12">
        {{ Form::label('lead', __('Lead')) }}
        {!! Form::select('lead', $leads, null,array('class' => 'form-control font-style selectric','required'=>'required')) !!}
        @error('lead')
        <span class="invalid-lead" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group  col-md-12">
        {{ Form::label('label', __('Label'),array('class'=>'form-control-label')) }}
        <div class="bg-color-label">
            @foreach($labels as $k=>$label)
                <div class="custom-control custom-radio {{$label->color}} mb-3">
                    <input class="custom-control-input" name="label" id="customCheck_{{$k}}" type="radio" value="{{$label->id}}" {{($label->id==$project->label)?'checked':''}}>
                    <label class="custom-control-label" for="customCheck_{{$k}}"></label>
                </div>
            @endforeach
        </div>
    </div>
</div>

</div>

<div class="row">
    <div class="form-group col-md-12">
        {{ Form::label('description', __('Description')) }}
        {!! Form::textarea('description', null, ['class'=>'form-control font-style','rows'=>'2']) !!}
        @error('description')
        <span class="invalid-description" role="alert">
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
