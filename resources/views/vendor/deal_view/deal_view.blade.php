@extends('vendor.layouts.app')

@section('title', 'Deal Views')

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
</style>
@endpush

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Deals View by Users</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @include('flash-message')
                        <div class="card-header">
                            <div class="card-title">Deal View Details</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="userList">
                                <thead>
                                    <tr>
                                        <th><strong>Sr. No.</strong></th>
                                        <th><strong>User Name</strong></th>
                                        <th><strong>Mobile Number</strong></th>
                                        <th><strong>Email ID</strong></th>
                                        <th><strong>Wedding Date</strong></th>
                                        <th><strong>Deal Title</strong></th>
                                        <th><strong>Viewed At</strong></th>
                                        <th><strong>Actions</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($dealViews))
                                    @php $i = 1; @endphp
                                    @foreach ($dealViews as $viewed)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $viewed->user_name }}</td>
                                        <td>{{ $phone = $viewed->user_phone }}</td>
                                        <td>{{ $viewed->user_email }}</td>
                                        <td>{{ $viewed->wedding_date }}</td>
                                        <td>{{ $viewed->deal_name }}</td>                                        
                                        <td>{{ $viewed->created_at }}</td>                                        
                                        <td width="28%">
                                            <a href="mailto:{{ $viewed->user_email }}" title="Send Mail"><i class="la la-envelope btn btn-success action-cons" aria-hidden="true"></i></a>
                                            <a href="tel:{{ $phone = $viewed->user_phone }}" title="Call"><i class="la la-phone  btn btn-success action-cons" aria-hidden="true"></i></a>                                            
                                        </td>
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
        $(document).ready(function() {

            $('#userList').DataTable();

        });
    </script>

    @endpush