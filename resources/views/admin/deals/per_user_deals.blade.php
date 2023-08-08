@extends('admin.layouts.app')

@section('title', 'Per User Deals')

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
            <h4 class="page-title">Per User Deals</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @include('flash-message')
                        <div class="card-header">
                            <div class="card-title">Deals Summary Per User</div>
                        </div>
                        <div class="card-body">
                            <form style="margin-bottom: 20px;" method="post" action="{{ route('deals.perusers') }}">
                                @CSRF
                                <div class="row">
                                    <div class="col-md-6 col-sm-6m col-xs-12">
                                        <select style="width: 80%; display: inline-block;" name="filter_data" class="form-control" required>
                                            <option value="">-Select Duration-</option>
                                            <option value="7days">7 Days</option>
                                            <option value="onemonth">One Month</option>
                                            <option value="threemonth">Three Month</option>
                                            <option value="All">All Deals</option>
                                        </select>
                                            <input type="submit" name="submit" class="btn btn-success" value="Filter">
                                    </div>
                                    
                                </div>
                            </form>
                            <table class="table table-bordered" id="userList">
                                <thead>
                                    <tr>
                                        <th><strong>Sr. No.</strong></th>
                                        <th><strong>Advertiser Name</strong></th>
                                        <th><strong>Total Deals</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($dealViews))
                                    @php $i = 1;  @endphp
                                    @foreach ($dealViews->unique('user_id') as $viewed)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $viewed->user->fname . ' ' . $viewed->user->lname }}</td>                                        
                                        <td>
                                            {{$dealViews->where('user_id', $viewed->user->id)->count()}}
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