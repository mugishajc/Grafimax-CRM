{{Form::open(array('url'=>'clients','method'=>'post'))}}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{Form::label('name',__('Name')) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Client Name'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{Form::label('number',__('Telephone number'))}}
            {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Client Phone number'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{Form::label('note',__('Note'))}}
            {{Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter Client Note (ex:Address,...)'),'minlength'=>"6",'required'=>'required'))}}
        </div>
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
        {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
    </div>
</div>

{{Form::close()}}

