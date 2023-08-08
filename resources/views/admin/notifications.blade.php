@extends('admin.layouts.app')

@section('title', 'Notifications')

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
            <h4 class="page-title">All Notifications</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @include('flash-message')
                        <div class="card-header">
                            <div class="card-title">Notifications for you</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="userList">
                                <thead>
                                    <tr>
                                        <th><strong>Sr. No.</strong></th>
                                        <th><strong>Details</strong></th>
                                        <th><strong>Actions</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($notifications))
                                    @php $i = 1; @endphp
                                    @foreach ($notifications as $notification)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $notification->data['body'] }}</td>                                       
                                        <td width="28%">
                                            <a href="{{ $notification->data['url'] }}" title="Call"><i class="la  la-check-circle  btn btn-success action-cons" aria-hidden="true"> click here</i></a>                                            
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