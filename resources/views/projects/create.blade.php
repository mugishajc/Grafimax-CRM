@extends('layouts.admin')
@push('script-page')
@endpush

@section('page-title')
  Job Card
@endsection
<!-- @push('script-page')
    <script>
        function getTask(obj, project_id) {
            $('#job_id').empty();
            var milestone_id = obj.value;
            $.ajax({
                url: '{!! route('invoices.milestone.task') !!}',
                data: {
                    "milestone_id": milestone_id,
                    "project_id": project_id,
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                success: function (data) {
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].title + '</option>';

                    }
                    $('#job_id').append(html);
                },
                error: function (data) {
                    data = data.responseJSON;
                    toastrs('Error', data.error, 'error')
                }
            });
        }

        function hide_show(obj) {
            if (obj.value == 'milestone') {
                document.getElementById('milestone').style.display = 'block';
                document.getElementById('other').style.display = 'none';
            } else {
                document.getElementById('other').style.display = 'block';
                document.getElementById('milestone').style.display = 'none';
            }
        }

    </script>
@endpush -->

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Job</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">Jobcard</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <div class="d-flex justify-content-between w-100">
                            <h4>Create new job</h4>

                           
                                <a href="#" class="btn btn-sm btn-warning" data-url="{{ route('notes.create') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Create Note')}}">
                                  <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.861 49.861"><path d="M45.963 21.035h-17.14V3.896C28.824 1.745 27.08 0 24.928 0s-3.896 1.744-3.896 3.896v17.14H3.895C1.744 21.035 0 22.78 0 24.93s1.743 3.895 3.895 3.895h17.14v17.14c0 2.15 1.744 3.896 3.896 3.896s3.896-1.744 3.896-3.896v-17.14h17.14c2.152 0 3.896-1.744 3.896-3.895a3.9 3.9 0 0 0-3.898-3.896z" fill="#010002"/></svg>
                                  </span>
                                    Add item
                                </a>
                        
                        </div> -->
                    </div>
                    <div class="card-body">
                        <div class="staff-wrap">
                            <div class="row">
                                
                            {{ Form::open(array('url' => 'projects')) }}
<div class="row">

<div class="form-group col-md-2">
        {{ Form::label('client', __('Client')) }}
        {!! Form::select('client', $clients, null,array('class' => 'form-control font-style selectric','required'=>'required')) !!}
        @error('client')
        <span class="invalid-client" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        {{ Form::label('user', __('Performed By')) }}
        {!! Form::select('user[]', $users, null,array('class' => 'form-control font-style selectric','data-toggle'=>'select','required'=>'required')) !!}
        @error('user')
        <span class="invalid-user" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>
    
    <div class="form-group col-md-2">
        {{ Form::label('date', __('Start Date')) }}
        {{ Form::text('start_date', '', array('class' => 'form-control datepicker','required'=>'required')) }}
        @error('start_date')
        <span class="invalid-start_date" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        {{ Form::label('due_date', __('Due Date')) }}
        {{ Form::text('due_date', '', array('class' => 'form-control datepicker','required'=>'required')) }}
        @error('due_date')
        <span class="invalid-due_date" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    

    <div class="form-group col-md-2">
        {{ Form::label('name', __('Job Name')) }}
        {{ Form::text('name', '', array('class' => 'form-control','required'=>'required')) }}
        @error('name')
        <span class="invalid-name" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        {{ Form::label('price', __('Price')) }}
        {{ Form::number('price', '', array('class' => 'form-control','required'=>'required')) }}
        @error('price')
        <span class="invalid-price" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
        @enderror
    </div>
    
    
<div class="row">
    <div class="form-group  col-md-12">
        

    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr >
                                    <th style="width:15em;">Item</th>
                                    <th style="width:8em;">Size</th>
                                    <th>Quantity</th>
                                    <th style="width:10em;">Price</th>
                                    <th style="width:10em;">subtotal <th>
                                        
                                </tr>
<!-- table row 
                                style="outline: thin solid" -->

                               

                                
                            </table>

                            <a href="#"  data-toggle="modal" data-target="#myModal" id="open" class="btn btn-sm btn-warning">
                                            <span><i class="fas fa-plus"></i></span>
                                            {{__('Add')}}
                                        </a>

                                        <!-- <form method="post" action="#" id="form">
        @csrf
  <!-- Modal -->
  <div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="alert alert-danger" style="display:none"></div>
      <div class="modal-header">
      	.
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
        {{ Form::text('subtotal', '', array('class' => 'form-control','required'=>'required')) }}
        @error('subtotal')
        <span class="invalid-client" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>
    
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
        {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
    </div>
</div> -->

      <!-- <div class="modal-footer">
      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-success" id="ajaxSubmit">Save changes</button>
        </div>
    </div> -->
  </div>
</div>
  </form>


                        </div>
                    </div>
                </div>
            </div>



    </div>
    
    <div class="form-group col-md-6">
        {{ Form::label('received_by', __('Received By')) }}
        {{Auth::user()->name}}
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
        {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
    </div>
</div>

{{ Form::close() }}




                            
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    


    
    </section>


@endsection
