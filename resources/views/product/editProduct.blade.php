@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit Products
                    <span class="float-right">
                        <a href="{{ route('products') }}" class="btn btn-primary"> <i class="fas fa-chevron-left"></i> Back</a>
                    </span>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="post" action="{{route('editProduct',$product->id)}}">
                        <div class="form-group">
                            <input type="hidden" value="{{csrf_token()}}" name="_token" />
                            <label for="title">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{$product->name}}" />
                        </div>
                        <div class="form-group">
                            <label for="title">Qty:</label>
                            <input type="text" class="form-control" name="qty" value="{{$product->qty}}" />
                        </div>
                        <div class="form-group">
                            <label for="title">Amount:</label>
                            <input type="text" class="form-control" name="amount" value="{{$product->amount}}" />
                        </div>
                        <div class="float-right">
                            <button type="reset" class="btn">Reset</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
