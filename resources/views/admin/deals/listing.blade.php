@extends('admin.layouts.app')

@section('title', 'Admin : Deals List')

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

    .filter-input-list {
        display: inline-flex;
    }

    .filter-input-list .filter-input,
    .filter-select {
        padding: 5px;
        font-size: revert;
        margin: 0px 10px 5px 2px;
    }

</style>
<link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css" type="text/stylesheet">
@endpush

@section('content')
@php
use App\Models\VendorCompanyProfile;
@endphp
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Deals Management</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @include('flash-message')
                        <div class="card-header d-block d-lg-flex justify-content-between">
                            <div class="card-title">Deals List</div>
                            <div>
                                <a href="{{ route('deals.create') }}" class="btn btn-danger mb-2" title="add users">Add New Deal</a>
                                <a href="{{ route('admin.download_deals') }}" class="btn btn-success mb-2" title="add users">Download Deals</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="filter-input-list">

                                <input type="text" class="form-control filter-input" placeholder="Search By Title" data-column="1">
                                <input type="text" class="form-control filter-input" placeholder="Search By Company" data-column="6">
                                <input type="text" class="form-control filter-input" placeholder="Search By Category" data-column="7">
                                <input type="text" class="form-control filter-input" placeholder="Search By Deal Code" data-column="8">
                                <select class="form-control filter-select" data-column="12">
                                    <option class="all" value="" data-column="12">All</option>
                                    <option class="select-active" value="Active" data-column="12">Active</option>
                                    <option class="select-Inactive" value="Inactive" data-column="12">Inactive</option>
                                </select>

                            </div>



                            <div class="table-responsive">
                                <table style="width: 100%;" class="table table-bordered" id="userList">
                                    <thead>
                                        <tr>
                                            <th><strong>Date Created</strong></th>
                                            <th><strong>Title</strong></th>
                                            <th><strong>Image</strong></th>
                                            <th><strong>Price</strong></th>
                                            <th><strong>Offer Price</strong></th>
                                            <th><strong>User</strong></th>
                                            <th><strong>Company</strong></th>
                                            <th><strong>Category</strong></th>
                                            <th><strong>Deal Code</strong></th>
                                            <th><strong>City</strong></th>
                                            <th><strong>Additional Cities</strong></th>
                                            <th><strong>Is featured?</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Actions</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($deals))
                                        @php $i = 1; @endphp
                                        @foreach($deals as $key => $deal)
                                        <tr>
                                            <td>{{ $deal->created_at->toDateString() }}</td>
                                            <td>{{ isset($deal->title) ? $deal->title : ''}}</td>
                                            <td>
                                                @if(isset($deal->image))
                                                <img src="{{asset($deal->image)}}" alt="{{ isset($deal->title) ? $deal->title : ''}}" width="70">
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                            <td>${{ isset($deal->price) ? $deal->price : ''}}</td>
                                            <td>${{ isset($deal->offer_price) ? $deal->offer_price : '--'}}</td>
                                            <td>{{ !empty($deal->user) ? (isset($deal->user->fname) ? $deal->user->fname : '') : ''}}</td>
                                            <td>
                                                @if (!empty($deal->user))
                                                @php
                                                $vendorcompany = VendorCompanyProfile::select('*')->where('field_key',
                                                'company_name')->where('user_id',$deal->user->id)->get();
                                                @endphp
                                                @foreach ($vendorcompany as $key => $item)
                                                {{$item->field_value}}
                                                @endforeach
                                                @endif
                                            </td>
                                            <td>{{ !empty($deal->category) ? (isset($deal->category->name) ? $deal->category->name : '') : ''}}</td>
                                            <td>{{ !empty($deal->discountcode) ? (isset($deal->discountcode) ? $deal->discountcode : '') : ''}}</td>
                                            <td>{{ !empty($deal->state) ? (isset($deal->state->name) ? $deal->state->name : '') : ''}}</td>
                                            <td>
                                                @if ($deal->multiple_cities != 'null' && $deal->multiple_cities != 'NULL' && !empty($deal->multiple_cities))
                                                @foreach (json_decode($deal->multiple_cities) as $cityn)
                                                @foreach ($cities->where('id', $cityn)->where('id', '!=', $deal->state->id) as $city)
                                                {{$city->name}} <br>
                                                @endforeach
                                                @endforeach
                                                @endif
                                            </td>
                                            <td>{{ (($deal->is_featured == 1) ? 'Yes' : 'No') }}</td>

                                            <td class="">
                                                <span class="{{$deal->status == 1 ?'active' : 'inactive'}} {{$deal->status == 1 ?'badge badge-success' : 'badge badge-danger'}}">
                                                    {{ (($deal->status == 1) ? 'Active' : 'Inactive') }}
                                                </span>
                                            </td>

                                            <td width="20%">
                                                <a class="text-decoration-none" title="Preview" href="{{route('vendor.dealdetail', $deal->id)}}" target="_blank">
                                                    <i class="la la-eye btn btn-success action-cons px-2 mb-1" aria-hidden="true"></i>
                                                </a>
                                                <a class="text-decoration-none" title="Download Preview" href="{{ route('home.deal_download', $deal->slug) }}" target="_blank">
                                                    <i class="la la-cloud-download btn btn-success action-cons px-2 mb-1" aria-hidden="true"></i>
                                                </a>
                                                <a class="text-decoration-none" href="{{route('deals.edit',$deal->id)}}" title="Edit"><i class="la la-edit btn btn-success action-cons px-2 mb-1" aria-hidden="true"></i></a>
                                                <a class="text-decoration-none" href="{{route('deals.delete',$deal->id)}}" onclick="return confirm('Are you sure to want delete this item?');" title="Delete"><i class="la la-trash-o  btn btn-danger action-cons px-2 mb-1" aria-hidden="true"></i></a>


                                                @if($deal->status == 0)
                                                <a class="text-decoration-none" href="{{route('deals.approve', $deal->id)}}" title="Approve">
                                                    <i class="la la-check btn btn-success action-cons px-2 mb-1" aria-hidden="true"></i>
                                                </a>
                                                @else
                                                <a class="text-decoration-none" href="#" data-toggle="modal" data-target="#Modal_{{$deal->id}}" href="" title="Deny">
                                                    <i class="la la-times btn btn-danger action-cons px-2 mb-1" aria-hidden="true"></i>
                                                </a>
                                                @endif


                                            </td>
                                            <!-- Modal -->
                                            <div class="modal fade" id="Modal_{{$deal->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form method="get" action="{{route('deals.deny',$deal->id)}}">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Deny Deals | {{$deal->title}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlTextarea1">Reason
                                                                        for denying!</label>
                                                                    <textarea class="form-control" id="admin_comment" name="admin_comment" rows="4"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel
                                                                </button>
                                                                <button type="submit" class="btn btn-danger">
                                                                    Deny This Deal!
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
    </div>


    @endsection

    @push('customJs')
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#userList').DataTable();

        });

    </script>

    <script>
        var table = $('#userList').DataTable();
        $('.filter-input').keyup(function() {
            table.column($(this).data('column'))
                .search($(this).val())
                .draw();
        });

    </script>

    <script>
        var table = $('#userList').DataTable();

        $('.filter-select').change(function() {
            console.log($(this).val());
            table.column($(this).data('column'))
                .search($(this).val() ,true, true, false)
                .draw();
        });

    </script>


    @endpush
