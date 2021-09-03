{{ Form::model($label, array('route' => array('labels.update', $label->id), 'method' => 'PUT')) }}
<div class="form-group">
    {{ Form::label('name', __('Label Name')) }}
    {{ Form::text('name', null, array('class' => 'form-control','required'=>'required')) }}
</div>
<div class="form-group  col-md-12">
    {{ Form::label('name', __('Color')) }}
    <div class="bg-color-label">
        @foreach($colors as $k=>$color)
            <div class="custom-control custom-radio  mb-3 {{$color}}">
                <input class="custom-control-input" name="color" id="customCheck_{{$k}}" type="radio" value="{{$color}}" @if($label->color == $color) checked @endif>
                <label class="custom-control-label " for="customCheck_{{$k}}"></label>
            </div>
        @endforeach
    </div>
</div>
<div class="form-group text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Update'),array('class'=>'btn btn-primary'))}}
</div>

{{ Form::close() }}
