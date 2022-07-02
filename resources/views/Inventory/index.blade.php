@extends('layouts.admin')


@section('page-title')
    Add new Inventory
@endsection
@push('script-page')
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Inventory Unit</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">Inventory</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="container">


                            <form action="{{ route('Inventory.create') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label class="my-1 mr-2" for="pn">Product Name</label>
                                    {!! Form::select('ProdName', $productnames, null,array('class' => 'custom-select my-1 mr-sm-2','required'=>'required')) !!}
                                    @error('unit')
                                    <span class="invalid-unit" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>

                                  <div class="form-group col-md-6">
                                    <label class="my-1 mr-2" for="quantity">Quantity</label>
                                    <input type="number" class="custom-select my-1 mr-sm-2" id="validationServerUsername"name="QTY"  aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                      Quantity is needed!
                                    </div>
                                  </div>

                                </div>

                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label class="my-1 mr-2" for="costvalue">Cost Value</label>
                                    <div class="input-group my-1 mr-2">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">RWF</div>
                                        </div>
                                        <input type="number" class="input-group-text"  id="cost_value"name="CV" aria-describedby="inputGroupPrepend3 cost-value" required>
                                        <div id="cost_value" class="invalid-feedback">
                                          Cost value is needed!
                                        </div>
                                      </div>

                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="my-1 mr-2" for="product_unit">Select Product Unit</label>
                                    {!! Form::select('PU', $productunits, null,array('class' => 'custom-select my-1 mr-sm-2','required'=>'required')) !!}
                                    @error('unit')
                                    <span class="invalid-unit" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                </div>




                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="my-1 mr-2" for="validationDoneby">Done by</label>
                                        <input type="text" class="custom-select my-1 mr-sm-2" id="validationServer01"  value="{{Auth::user()->name}}" readonly>

                                      </div>
                                    <div class="form-group col-md-6">

                                      <label class="my-1 mr-2" for="total">Note</label>

                                       <textarea class="form-control" name="note" rows="5"></textarea>


                                    </div>


                                  </div>


                                <div class="form-row justify-content-center">
                                <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                                </div>

                                </div>
                              </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
