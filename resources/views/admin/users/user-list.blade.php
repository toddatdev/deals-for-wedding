@extends('admin.layouts.app')

@section('title', 'User-List')

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
            <h4 class="page-title">Users Section</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @include('flash-message')
                        <div class="card-header">
                            <div class="card-title">Users List</div>
                            <a href="{{ route('admin.add-users') }}" style="float: right;margin-top: -20px;" class="btn btn-danger" title="add users">Add New Users</a>
                        </div>
                        <div class="card-body">
                            <form style="margin-bottom: 20px;" method="post" action="{{ url('/admin/download-user-list') }}">
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
                            </form>
                            <table class="table table-bordered" id="userList">
                                <thead>
                                    <tr>
                                        <th><strong>Date Created</strong></th>
                                        <th><strong>User Name</strong></th>
                                        <th><strong>Mobile Number</strong></th>
                                        <th><strong>Email ID</strong></th>
                                        <th><strong>Wedding Date</strong></th>
                                        <th><strong>Role</strong></th>
                                        <th><strong>Status</strong></th>
                                        <th><strong>Actions</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($userDetails))
                                    @php $i = 1; @endphp
                                    @foreach($userDetails as $key => $users)
                                    <tr>
                                        <td>{{ $users->created_at->toDateString() }}</td>
                                        <td>{{ $users->fname }} {{ $users->lname }}</td>
                                        <td>{{ $phone = isset($users->userDetails->phone) ? $users->userDetails->phone : 'Number not provided' }}</td>
                                        
                                        <td>{{ $users->email }}</td>
                                        <td>{{ isset($users->userDetails->wedding_date) ? Carbon\Carbon::parse($users->userDetails->wedding_date)->format('m-d-Y') : 'Date not provided' }}
                                        </td>
                                        <td>

                                            <?php
                                            if ($users->role == "2")
                                                echo "User";

                                            if ($users->role == "3")
                                                echo "Advertiser";
                                            ?>
                                        </td>
                                        <td>{{ (($users->status == 1) ? 'Active' : 'Inactive') }}</td>
                                        <td width="28%">
                                            <a href="{{route('admin.edit-user',$users->id)}}" title="Edit"><i class="la la-edit btn btn-success action-cons" aria-hidden="true"></i></a>
                                            <a href="{{route('admin.delete-user',$users->id)}}" title="Delete"><i class="la la-trash-o  btn btn-danger action-cons" aria-hidden="true"></i></a>
                                            @if($users->role =='3')
                                            <a href="{{route('admin.vendor.company_profile',$users->id)}}" title="Company Profile" class="btn btn-default">Company Profile</a>
                                            @endif
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