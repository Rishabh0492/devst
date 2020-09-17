@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Product</div>

                <div class="card-body">
                <div class="col-md-8 col-md-offset-1">
                @if(session()->has('message'))
                    <div class="invalid-feedback alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form class="form-horizontal" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data" data-parsley-validat >
                            <div class="box-body">
                                {{ csrf_field() }}
                               

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id " class="col-sm-4 control-label">Category</label>
                            <div class="col-sm-5"> 
                                       <select name="category_id" class="form-control" value="">
                                        <option value="">Select Category</option>
                                        @foreach ($category as $key=>$value)         
                                             <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                       
                                       </select>
                                        @if ($errors->has('category_id'))
                                            <span class="help-block error">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                             <div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
                                    <label for="product_name" class="col-sm-4 control-label">Product Name</label>
                                    <div class="col-sm-5">
                            <input type="text" class="form-control" id="product_name" name="product_name"
                                               placeholder="Enter Product Name">
                                        @if ($errors->has('product_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('product_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                             <div class="form-group{{ $errors->has('product_image') ? ' has-error' : '' }}">
                                    <label for="product_image" class="col-sm-4 control-label">Product Image</label>
                                    <div class="col-sm-5">
                            <input type="file" class="form-control" id="product_image" name="product_image">
                            <p id="output"></p> 
                                        @if ($errors->has('product_image'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('product_image') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div> 

                                 <div class="form-group{{ $errors->has('product_description') ? ' has-error' : '' }}">
                                    <label for="product_description" class="col-sm-4 control-label">Product Description</label>
                                    <div class="col-sm-5">
                            <textarea class="form-control" id="product_description" name="product_description" placeholder="Enter Description" ></textarea>
                                        @if ($errors->has('product_description'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('product_description') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div> 


                                 <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                    <label for="price" class="col-sm-4 control-label">Product Price</label>
                                    <div class="col-sm-5">
                            <input type="text" class="form-control" id="price" name="price"
                                               placeholder="Enter Price">
                                        @if ($errors->has('price'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div> 

                            <div class="box-footer">
                                <button type="submit" name="submit" class="btn btn-success pull-right">Save</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
 <script type="text/javascript"> 
        $('#product_image').on('change', function() { 
  
            var numb = $(this)[0].files[0].size/5270;
            numb = numb.toFixed(2);

            if (numb > 5) { 
               
                 $("#output").html('<b style="color: red;">' + 
                   'to big, maximum is 5MB. You image size is:: ' + numb + " MB" + '</b>'); 
            } else { 
                $("#output").html('<b>' + 
                   'This image size is: ' + numb + " MB" + '</b>'); 
            } 
        }); 
    </script> 
@endsection