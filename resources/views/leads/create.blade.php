{{ Form::open(array('url' => 'leads')) }}
<div class="row">
    <div class="form-group col-md-6 ">
        {{ Form::label('name', __('Name')) }}
        {{ Form::text('name', '', array('class' => 'form-control','required'=>'required')) }}
    </div>

    <div class="form-group  col-md-6">
        {{ Form::label('price', __('Price')) }}
        {{ Form::number('price', '', array('class' => 'form-control','required'=>'required')) }}
    </div>
    <div class="form-group  col-md-6">
        {{ Form::label('stage', __('Stage')) }}
        {{ Form::select('stage', $stages,null, array('class' => 'form-control font-style selectric','required'=>'required')) }}
    </div>
    @if(\Auth::user()->type=='company')
        <div class="form-group  col-md-6">
            {{ Form::label('owner', __('Lead User')) }}
            {!! Form::select('owner', $owners, null,array('class' => 'form-control font-style selectric','required'=>'required')) !!}
        </div>
    @endif
    <div class="form-group  col-md-6">
        {{ Form::label('client', __('Client')) }}
        {!! Form::select('client', $clients, null,array('class' => 'form-control font-style selectric','required'=>'required')) !!}
    </div>
    <div class="form-group  col-md-6">
        {{ Form::label('source', __('Source')) }}
        {!! Form::select('source', $sources, null,array('class' => 'form-control font-style selectric','required'=>'required')) !!}
    </div>
    <div class="form-group  col-md-12">
        {{ Form::label('notes', __('Notes')) }}
        {!! Form::textarea('notes', '',array('class' => 'form-control','rows'=>'3')) !!}
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
        {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
    </div>
</div>

{{ Form::close() }}

