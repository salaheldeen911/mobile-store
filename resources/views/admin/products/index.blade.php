@extends('layouts.admin-app')

@push('styles')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 p-0">
                <div class="page-header p-0">
                    <div class="page-title">
                        <h1>All Products</h1>
                    </div>
                </div>
            </div>
            <!-- /# column -->
            <div class="col-lg-4 p-l-0 title-margin-left">
                <div class="page-header">
                    <div class="page-title">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Products</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /# column -->
        </div>
        <div class="row">
            <a class="btn btn-primary" href="{{ route('admin.products.create') }}">Add Product</a>
            <div class="card w-100">
                <table id="products" class="display table table-borderd table-hover w-100">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Quantity</th>
                            <th>Old_Price</th>
                            <th>Price</th>
                            <th>seller_id</th>
                            <th>created_at</th>
                            <th>updated_at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src={{ asset('admin/js/lib/data-table/datatables.min.js') }}></script>
        <script src={{ asset('admin/js/lib/data-table/dataTables.buttons.min.js') }}></script>
        <script src={{ asset('admin/js/lib/data-table/jszip.min.js') }}></script>
        <script src={{ asset('admin/js/lib/data-table/pdfmake.min.js') }}></script>
        <script src={{ asset('admin/js/lib/data-table/vfs_fonts.js') }}></script>
        <script src={{ asset('admin/js/lib/data-table/buttons.html5.min.js') }}></script>
        <script src={{ asset('admin/js/lib/data-table/buttons.print.min.js') }}></script>
        <script src={{ asset('admin/js/lib/data-table/buttons.colVis.min.js') }}></script>
        <script src={{ asset('admin/js/lib/data-table/datatables-init.js') }}></script>

        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript">
            // $(document).ready(function() {
            //     var table = $('#products').DataTable({
            //         processing: true,
            //         serverSide: true,
            //         ajax: "{{ route('admin.show.products') }}",
            //         columns: [{
            //                 data: 'name',
            //                 name: 'name'
            //             },
            //         ]
            //     })
            // })
            $(function() {
                var table = $('#products').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.show.products') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            'orderable': false,
                            'searchable': false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'category',
                            name: 'category'
                        },
                        {
                            data: 'brand',
                            name: 'brand'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'old_price',
                            name: 'old_price'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'seller_id',
                            name: 'seller_id'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });

            function deleteProduct(a) {
                if (confirm("Do you want to delete this product?")) {
                    $(a).next('form').submit();
                } else {
                    return false;
                }
            }
        </script>
    @endpush
