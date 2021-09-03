{{ Form::open(array('url' => 'projects')) }}
<div class="row">

<div class="form-group col-md-6">
        {{ Form::label('item_name', __('Item Name')) }}
        {{ Form::text('item_name', '', array('class' => 'form-control','required'=>'required')) }}
        @error('item_name')
        <span class="invalid-client" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>
    
    <div class="form-group col-md-6">
        {{ Form::label('size', __('Size')) }}
        {{ Form::text('size', '', array('class' => 'form-control','required'=>'required')) }}
        @error('size')
        <span class="invalid-name" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('quantity', __('quantity')) }}
        {{ Form::number('quantity', '', array('class' => 'form-control','required'=>'required')) }}
        @error('q')
        <span class="invalid-price" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    <div class="form-group col-md-6">
    {{ Form::label('priceperunit', __('Per per Unit')) }}
        {{ Form::number('priceperunit', '', array('class' => 'form-control','required'=>'required')) }}
        @error('priceperunit')
        <span class="invalid-price" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('subtotal', __('Subtotal')) }}
        {{ Form::text('subtotal', '', array('class' => 'form-control datepicker','required'=>'required')) }}
        @error('subtotal')
        <span class="invalid-due_date" role="alert">
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

