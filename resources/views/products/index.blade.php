@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Products</h1>
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create Product</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Brand Name</th>
                            <th>Cost Price</th>
                            <th>Sell Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->brand_name }}</td>
                                <td>{{ $product->cost_price }}</td>
                                <td>{{ $product->sell_price }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection