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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($status)
                        <table class="table table-bordered table-hover table-striped" width="100%" id="productTable">
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
@section('js')
<script type="text/javascript" src="{{ asset('DataTables/js/jquery.dataTables.js') }}"></script>
    <script>
        $(function () {
            $('#productTable').DataTable({
                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": {
                url : "{{route('searchProducts')}}",
                    type : 'POST',
                    data:{
                        '_token':"{{csrf_token()}}"
                    },
                },
                columnDefs: [
                   { orderable: false, targets: -1 }
                ],
                scroller: {
                    loadingIndicator: true
                },
                aLengthMenu: [
                    [10, 25, 50, 100, - 1],
                    [10, 25, 50, 100, "All"]
                ],
                iDisplayLength: 10,
            } );
        });
    </script>
@endsection
