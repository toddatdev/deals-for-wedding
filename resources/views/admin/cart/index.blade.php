@extends('admin.layouts.app')

@section('title', 'Vendor : Deals List')

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

        ::marker {
            color: transparent;
        }
    </style>
@endpush

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @include('flash-message')
                            <div class="card-header">
                                <div class="card-title">Vendor Pending Cart Listing</div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="userList">
                                        <thead>
                                        <tr>
                                            <th><strong>Sr. No.</strong></th>
                                            <th><strong>Vendor Name</strong></th>
                                            <th><strong>Vendor Email</strong></th>
                                            <th><strong>Title</strong></th>
                                            <th><strong>Image</strong></th>
                                            <th><strong>Original Price</strong></th>
                                            <th><strong>Deal Price</strong></th>
                                            <th><strong>Category</strong></th>
                                            <th><strong>City</strong></th>
                                            <th><strong>Additional Cities</strong></th>
{{--                                            <th><strong>--}}
{{--                                                  Vendor Details--}}
{{--                                                </strong>--}}
{{--                                            </th>--}}

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($deals))
                                            @php $i = 1; @endphp
                                            @foreach($deals as $key => $deal)
                                                <tr>
                                                    <td>{{ $i }}</td>

                                                    <td>{{ isset($deal->user->fname) ? $deal->user->fname : ''}} {{ isset($deal->user->lname) ? $deal->user->lname : ''}}</td>
                                                    <td><a class="text-decoration-none text-dark" href="mailto:{{ isset($deal->user->email) ? $deal->user->email : ''}}">{{ isset($deal->user->email) ? $deal->user->email : ''}}</a></td>

                                                    <td>{{ isset($deal->title) ? $deal->title : ''}}</td>
                                                    <td>
                                                        @if(isset($deal->image))
                                                            <img src="{{asset($deal->image)}}"
                                                                 alt="{{ isset($deal->title) ? $deal->title : ''}}"
                                                                 width="70" height="50">
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>${{ isset($deal->price) ? $deal->price : ''}}</td>
                                                    <td>${{ isset($deal->offer_price) ? $deal->offer_price : ''}}</td>
                                                    <td>{{ !empty($deal->category) ? (isset($deal->category->name) ? $deal->category->name : '') : ''}}
                                                    </td>
                                                    <td>{{ !empty($deal->state) ? (isset($deal->state->name) ? $deal->state->name : '') : ''}}
                                                    </td>
                                                    <td>
                                                        @if (isset($deal->multiple_cities))
                                                            @if(is_array(json_decode($deal->multiple_cities)))
                                                                @foreach (json_decode($deal->multiple_cities) as $cityn)
                                                                    @foreach ($cities->where('id', $cityn)->where('id', '!=', $deal->state->id) as $city)
                                                                        {{$city->name}} <br>
                                                                    @endforeach
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    </td>

{{--                                                    <td>--}}
{{--                                                        <a class="btn btn-sm btn-success"--}}
{{--                                                           data-toggle="modal" data-target="#viewVendor{{$deal->id}}Details"--}}
{{--                                                           href="javascript:void(0)">--}}
{{--                                                            View Vendor Details--}}
{{--                                                        </a>--}}
{{--                                                    </td>--}}

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="viewVendor{{$deal->id}}Details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="text-center">
                                                                   <div class="d-flex justify-content-end px-2">
                                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                           <span aria-hidden="true">&times;</span>
                                                                       </button>
                                                                   </div>
                                                                    <h4 class="font-weight-bold">{{ isset($deal->user->fname) ? $deal->user->fname : ''}} {{ isset($deal->user->lname) ? $deal->user->lname : ''}}</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><b>Email: </b></p>
                                                                </div>

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
            <script>
                $(document).ready(function () {

                    $('#userList').DataTable();

                });
            </script>
            <script>
                setTimeout(() => {
                    sumjq = function (selector) {
                        var sum = 0;
                        $(selector).each(function () {
                            sum += Number($(this).val());
                        });
                        return sum;
                    }

                    $('#total_checkout_price').val(sumjq('.checkout_price'));
                }, 2000);
            </script>

    @endpush