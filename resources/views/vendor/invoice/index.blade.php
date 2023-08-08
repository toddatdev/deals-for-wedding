@extends('vendor.layouts.app')

@section('title', 'Invoice')

@push('customCSS')
    <style type="text/css" media="screen">
        .action-cons {
            font-size: 20px;
            font-weight: bold;
        }

        .action-cons:hover {
            font-size: 20px;
            color: #f8f9fa;
            background: #339af0;
        }

        button.dt-button {
            background-color: unset;
            border: 1px solid #00000026;
            padding: 4px 16px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.0), 0 2px 10px 0 rgba(0, 0, 0, 0.1);

        }

        button.dt-button.buttons-pdf.buttons-html5 {
            background-color: #ff0000 !important;
            color: #ffffff !important;
        }

        button.dt-button.buttons-excel.buttons-html5 {
            background-color: #0d8b2a;
            color: #ffffff;
        }
        button.dt-button.buttons-pdf.buttons-html5 {
            background-color: #ff0000 !important;
            color: #ffffff !important;
        }
        button.dt-button.buttons-excel.buttons-html5 {
            background-color: #0d8b2a;
            color: #ffffff;
        }

        button.dt-button.buttons-print {
            background-color: #ffc107;
            color: #ffffff;
        }
        button.dt-button.buttons-copy.buttons-html5 {
            background-color: hsl(0deg 0% 13%);
            color: #ffffff;
        }
    </style>
@endpush

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Invoices</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @include('flash-message')
                            <div class="card-header">
                                <div class="card-title">{{auth()->user()->fname}} Invoices</div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="userInvoice">
                                    <thead>
                                    <tr>
                                        <th><strong>Sr. No.</strong></th>
                                        <th><strong>User Name</strong></th>
                                        <th><strong>Title</strong></th>
                                        <th><strong>Category</strong></th>
                                        <th><strong>State</strong></th>
                                        <th><strong>City</strong></th>
                                        <th><strong>Additional Cities</strong></th>
                                        <th><strong>Price</strong></th>
                                        <th><strong>Offer Price</strong></th>
                                        <th><strong>Expiration Date</strong></th>
                                        <th><strong>Created At</strong></th>
                                        {{--                                        <th><strong>Actions</strong></th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @if(!empty($invoices))
                                        @php $i = 1; @endphp
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $invoice->user->fname }}</td>
                                                <td>{{ $invoice->title }}</td>
                                                <td>{{ $invoice->category->name }}</td>
                                                <td>{{ $invoice->state->name }}</td>
                                                <td>{{ $invoice->city }}</td>
                                                <td>
                                                    @php
                                                        $cities = App\Models\State::get();
                                                    @endphp
                                                    @if ($invoice->multiple_cities != 'null' && $invoice->multiple_cities != 'NULL' && !empty($invoice->multiple_cities))
                                                        @foreach ((array)json_decode($invoice->multiple_cities) as $cityn)
                                                            @foreach ($cities->where('id', $cityn)->where('id', '!=', $invoice->state->id) as $city)
                                                                {{$city->name}} <br>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>${{ $invoice->price }}</td>
                                                <td>${{ $invoice->offer_price }}</td>
                                                <td>{{ $invoice->expiration_date }}</td>
                                                <td>{{ $invoice->created_at }}</td>
                                                @php $i++; @endphp
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @endsection

        @push('customJs')
            <script>
                $(document).ready(function () {

                    $('#userList').DataTable();

                });
            </script>

            <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

            <script>
                $(document).ready(function () {
                    $('#userInvoice').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'excel', 'print',
                            {
                                extend: 'pdfHtml5',
                                pageSize: 'A3',
                                exportOptions: {
                                    columns:':visible',
                                    rows: ':visible'
                                }
                            },

                        ]
                    });
                });
            </script>

    @endpush