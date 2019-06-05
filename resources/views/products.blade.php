@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Products
                    <span class="float-right">
                        <a href="{{ route('addProduct') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New</a>
                    </span>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($status)
                        <table class="table table-border table-responsive table-hover table-striped" width="100%" id="productTable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i = 1)
                                @foreach ($products as $product) 
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td>{{$product->amount}}</td>
                                        <td>{{$product->created_at}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning " href="{{route('editProduct',$product->id)}}"> Edit </a>
                                            <a class="btn btn-sm btn-danger" href="{{route('deleteProduct',$product->id)}}"> Delete </a>
                                        </td>
                                    </tr>

                                @endforeach 
                            </tbody>
                        </table>
                        
                    @else
                        <div class="alert alert-warning" role="alert">
                            No Record Found
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
