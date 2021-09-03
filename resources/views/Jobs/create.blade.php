{{ Form::open(array('url' => 'jobs','method'=>'post')) }}
<div class="form-group col-md-12">
        {{Form::label('job_name',__('Job name'))}}
        {{Form::text('job_name',null,array('class'=>'form-control font-style','required'=>'required'))}}
    
    </div>
<div class="form-row col-md-12">
    <div class="form-group col-md-6">
        {{Form::label('Client',__('Client name'))}}
        {{Form::text('Client',null,array('class'=>'form-control font-style','required'=>'required'))}}
    
    </div>
    <div class="form-group col-md-6">
        {{Form::label('Tel',__('Telephone'))}}
        {{Form::text('Tel',null,array('class'=>'form-control font-style','required'=>'required'))}}
    </div>
    </div>
    
<div class="form-row col-md-12">
<div class="form-group col-md-6">
        {{Form::label('received_by',__('Received By'))}} <br>
        {{Auth::user()->name}}
    </div>
<div class="form-group col-md-6">
        {{Form::label('performed_by',__('Performed By'))}} 
        {{Form::text('performed_by',null,array('class'=>'form-control font-style','required'=>'required'))}}
    </div>
</div>
 
<div class="col-md-12 text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
</div>
{{ Form::close() }}

