@extends('admin.layouts.app')

@section('title', 'Advertiser Payments')

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
            <h4 class="page-title">Advertisers Payments</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @include('flash-message')
                        <div class="card-header">
                            <div class="card-title">Advertiser Payments</div>
                            {{-- <a href="{{ route('admin.add-advertiser') }}" style="float: right;margin-top: -20px;" class="btn btn-danger" title="add advertiser">Add New Advertiser</a> --}}
                        </div>
                        <div class="card-body">
                            {{-- <form style="margin-bottom: 20px;" method="post" action="{{ url('/admin/download-user-list') }}">
                                @CSRF
                                <div class="row">
                                    <div class="col-md-6 col-sm-6m col-xs-12">
                                        <select name="filter_data" class="form-control" required>
                                            <option value="">-Select-</option>
                                            <option value="Past">Past Wedding Date</option>
                                            <option value="Future">Future Wedding Date</option>
                                            <option value="All">All Wedding Date</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6m col-xs-12">
                                        <input type="submit" name="submit" class="btn btn-success" value="Download">
                                    </div>
                                </div>
                            </form> --}}
                            <table class="table table-bordered" id="userList">
                                <thead>
                                    <tr>
                                        <th><strong>Sr. No.</strong></th>
                                        <th><strong>User Name</strong></th>
                                        <th><strong>Email ID</strong></th>
                                        <th><strong>Value</strong></th>
                                        <th><strong>Payment Date</strong></th>
                                        <th><strong>Plan Expiry Date</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($payments))
                                    @php $i = 1; @endphp
                                    @foreach($payments->sortByDesc('created_at') as $payment)
                                    @if (isset($payment->user))
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $payment->user->fname }} {{ $payment->user->lname }}</td>
                                        <td>{{ $payment->user->email }}</td>
                                        <td>${{$payment->value}}</td>
                                        <td>{{$payment->created_at}}</td>
                                        <td>{{ $payment->user->plan_expiry_date }}</td>

                                        <td width="20%">
                                            <a class="text-decoration-none" title="Download" href="{{ route('download_payment',$payment->id ) }}" target="_blank">
                                                <i class="la la-cloud-download btn btn-success action-cons px-2 mb-1" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        @php $i++; @endphp
                                    </tr>
                                    @endif
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