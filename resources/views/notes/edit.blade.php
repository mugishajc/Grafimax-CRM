{{Form::model($note, array('route' => array('notes.update', $note->id), 'method' => 'PUT')) }}
<div class="row">
    <div class="form-group col-md-12">
        {{Form::label('title',__('Title'))}}
        {{Form::text('title',null,array('class'=>'form-control font-style','required'=>'required'))}}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('text', __('Description')) }}
        {!! Form::textarea('text', null, ['class'=>'form-control','rows'=>'4']) !!}
    </div>
    <div class="form-group  col-md-12">
        {{ Form::label('name', __('Color')) }}
        <div class="bg-color-label">
            @foreach($colors as $k=>$color)
                <div class="custom-control custom-radio  mb-3 {{$color}}">
                    <input class="custom-control-input" name="color" id="customCheck_{{$k}}"  type="radio" value="{{$color}}" @if($note->color == $color) checked @endif >
                    <label class="custom-control-label " for="customCheck_{{$k}}"></label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
        {{Form::submit(__('Update'),array('class'=>'btn btn-primary'))}}
    </div>
</div>
{{ Form::close() }}


