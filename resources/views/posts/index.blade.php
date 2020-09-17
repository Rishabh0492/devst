@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Product List</h2>
  <a class="btn btn-success" href="{{route('product.create')}}">ADD</a>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>No</th>
        <th>Product Name</th>
        <th>Product Category</th>
        <th>Product Image</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($product as $productItem)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $productItem->product_name  }}</td>
                                <td>{{ $productItem->Category->name }}</td>
                            <td><img id="product_0"  style="width: 70px;height: 70px;" class="form-control" src="{{ '/product_image/'.$productItem->product_image }}"  alt="Image not found" /></td>
                            <td>{{ $productItem->price }}</td>
                            <td>
                            <form action="{{route('product.destroy',[$productItem->id])}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}                                        
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                        </tr>
                        @endforeach
    </tbody>
  </table>
</div>

</body>
</html>

@endsection