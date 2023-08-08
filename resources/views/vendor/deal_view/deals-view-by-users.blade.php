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
                <h4 class="page-title">Deals Save by Users</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @include('flash-message')
                            <div class="card-header">
                                <div class="card-title">Users Save Deals List</div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="userList">
                                    <thead>
                                    <tr>
                                        <th><strong>Sr. No.</strong></th>
                                        <th><strong>User Name</strong></th>
                                        <th><strong>Email</strong></th>
                                        <th><strong>Phone</strong></th>
                                        <th><strong>Deal Name</strong></th>
                                        <th><strong>Price</strong></th>
                                        <th><strong>Category</strong></th>
                                        <th><strong>City</strong></th>
                                        <th><strong>Viewed At</strong></th>
                                        <th><strong>Actions</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if(!empty($dealViewByUsers))
                                        @php $i = 1; @endphp
                                        @foreach ($dealViewByUsers as $viewed)

                                            @php
                                                $userInformation = \App\Models\UserDetails::where('user_id', $viewed->user_id)->first();
                                            @endphp

                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $viewed->user->fname }} {{ $viewed->user->lname }}</td>
                                                <td><a class="text-dark" href="mailto:{{ $viewed->user->email }}">{{ $viewed->user->email }}</a></td>
                                                <td>
                                                    <a class="text-dark" href="tel:{{$userInformation->phone ?? ''}}">
                                                        {{$userInformation->phone ?? ''}}
                                                    </a>
                                                </td>
                                                <td>{{ $viewed->deal->title }}</td>
                                                <td>{{ $viewed->price }}</td>
                                                <td>{{ $viewed->categories }}</td>
                                                <td>{{ $viewed->city }}</td>
                                                <td>{{ $viewed->created_at->format('Y/M/d H:i:A') }}</td>
                                                <td>
                                                    <a href="mailto:{{ $viewed->user->email }}" title="Send Mail">
                                                        <i class="la la-envelope btn btn-warning action-cons" aria-hidden="true"></i></a>
                                                    <a href="tel:{{$userInformation->phone ?? ''}}" title="Call">
                                                        <i class="la la-phone  btn btn-success action-cons" aria-hidden="true"></i>

                                                    </a>
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