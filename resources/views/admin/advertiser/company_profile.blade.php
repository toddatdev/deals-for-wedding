@extends('admin.layouts.app')

@section('title', 'Company Profiles')

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
    .dataTables_length, .dataTables_info {
        float: left;
        margin-bottom: 15px;
    }
    .dt-buttons {
        margin-bottom: 15px;
    }
    .dataTables_paginate {
        margin-top: 15px !important;
    }
    .dataTables_wrapper {
		width: 100%;
		max-width: 1000px;
        margin: 0 auto;
	}
</style>
<link rel="stylesheet" href="{{asset('/public/css/buttons.bootstrap4.min.css')}}">
@endpush

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Company Profile Section</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @include('flash-message')
                        <div class="card-header">
                            <div class="card-title">Profile List</div>
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
                                        @foreach($fields as $key => $field)
                                        <th><strong>
                                            {{isset($field->input_label) ? $field->input_label : ''}}
                                        </strong></th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @foreach ($vendor as $item)
                                        <tr>
                                        @foreach($fields as $key => $field)
                                        <?php
                                        $profile_value = App\Models\VendorCompanyProfile::select('field_value')
                                                            ->where('user_id', $item->id)
                                                            ->where('field_key', $field->input_name)
                                                            ->first();
                                        ?>

                                        <td>@if(isset($profile_value->field_value) && ($field->input_type == 'file'))
								        	<div class="old_img">
				                                 <img src="{{asset('public/'.$profile_value->field_value)}}" style="width:100px">
				                            </div>
								        	@else{!! isset($profile_value->field_value) ? $profile_value->field_value : ''!!}@endif
                                        </td>
                                        @endforeach
                                    </tr>
                                        @endforeach
                                    
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

            $('#userList').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: [
                'csv', 'excel'
                ],
                
			"scrollX": true
            });

        });
    </script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="{{asset('/public/js/buttons.bootstrap4.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script src="{{asset('/public/js/jszip.min.js')}}"></script>
@endpush