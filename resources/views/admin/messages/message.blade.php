@extends('admin.layouts.app')

@section('title', 'Admin')

@push('customCSS')

@endpush

@section('content')


    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Admin Section</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            {{-- @include('flash-message')--}}
                            <div class="card-header">
                                <div class="card-title">Messages List</div>
                            </div>

                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="card-body">
                                <form action="{{!isset($message) ? route('admin.postNewMessages') : route('admin.updateMessages',$message->id)}}" enctype="multipart/form-data"
                                      method="post">
                                    @if(!isset($message))
                                    @csrf
                                    @else
                                        @csrf
                                        @method('PUT')
                                    @endif
                                    <div class="">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <label for="home_page_title" class="form-label font-weight-bold">Home Page Title / Description</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           id="home_page_title" name="home_page_title"
                                                    value="{{$message->home_page_title ?? ''}}"
                                                    >
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="six_month_subscription_title" class="form-label"><strong>Subscription 6 Month Title</strong></label>
                                                    <input type="text"
                                                           class="form-control"
                                                           value="{{ $message->six_month_subscription_title ?? ''}}"
                                                           id="six_month_subscription_title" name="six_month_subscription_title">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="one_year_subscription_title" class="form-label"><strong>Subscription 1 Year Title</strong></label>
                                                    <input type="text"
                                                           class="form-control"
                                                           value="{{ $message->one_year_subscription_title ?? ''}}"
                                                           id="one_year_subscription_title" name="one_year_subscription_title" >
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="checkout_modal_title" class="form-label"><strong>Checkout Modal Title</strong></label>
                                                    <input type="text"
                                                           class="form-control"
                                                           value="{{ $message->checkout_modal_title ?? ''}}"
                                                           id="checkout_modal_title" name="checkout_modal_title">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="checkout_modal_description" class="form-label"><strong>Checkout Modal Description</strong></label>
                                                    <input type="text"
                                                           class="form-control"
                                                           value="{{$message->checkout_modal_description ?? ''}}"

                                                           id="checkout_modal_description" name="checkout_modal_description">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="success_subscription_message" class="form-label"><strong>Success Subscription Message</strong></label>
                                                    <input type="text"
                                                           class="form-control"
                                                           value="{{$message->success_subscription_message ?? ''}}"

                                                           id="success_subscription_message" name="success_subscription_message">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="success_deal_create_message" class="form-label"><strong>Success Deal Create Message </strong></label>
                                                    <input type="text"
                                                           class="form-control"
                                                           value="{{$message->success_deal_create_message ?? ''}}"
                                                           id="success_deal_create_message" name="success_deal_create_message">
                                                </div>


                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Add / Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('customJs')
    {{-- <script type="text/javascript">
            @if (count($errors) > 0)
            $('#addNewAdminModal').modal('show');
            @endif
        </script> --}}

@endpush
