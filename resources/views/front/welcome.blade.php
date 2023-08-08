@php

    $categories = App\Models\Category::where('status', 1)->get();
    $states = App\Models\State::where('status', 1)->get();
    $settings = App\Models\Settings::where('id', 1)->first();

@endphp

        <!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Welcome to Deals for Wedding</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    @include('theme.header')
    @stack('customCSS')

    <style>
        .w-50-sm-100{
            width: 60%;
        }


        @media only screen and (max-width: 768px) {
            .w-50-sm-100{
                width: 100% !important;
            }
        }
    </style>

</head>

<body id="capture">
<main class="middle-area inner-page sidebar-fixed" id="category-page">

    @include('theme.nav-menu')

    <div class="bg-light vh-100 d-flex justify-content-center align-items-center">

        <?php
        $message = App\Models\DynamicMessage::first();
        ?>

        <div class="container">
            <div class="text-center mb-5 pb-4">
                <h1 class=" font-weight-bold" style="text-transform: capitalize;color: #f2a391">Welcome
                    @if(is_null(Auth::user()->last_login_at))
                    @else

                    @endif
                    <span class="text-dark">{{auth()->user()->fname ?? ''}} {{auth()->user()->lname ?? ''}} </span>to Deals for wedding</h1>
                <p>
                    {!! $message->home_page_title ?? ''!!}

                </p>
            </div>

            <form class="row w-50-sm-100 mx-auto" action="{{route('home.allDeals')}}" method="GET">
                <div class="col-12 mb-2">
                    <div class="form-group">
                        <label for="category" class="font-weight-bold">Select Category</label>
                        <select class="form-control form-control-lg" id="category" name="category" required="">
                            <option value="">Select Category</option>
                            @foreach($categories->sortBy('name') as $category)
                                <option value="{{isset($category->slug) ? $category->slug : ''}}"
                                        {{isset($_REQUEST['category']) ? (($_REQUEST['category'] == $category->slug) ? 'selected="selected"' : '') : ''}}>{{isset($category->name) ? $category->name : ''}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 mb-2">
                    <div class="form-group">
                        <label for="city" class="font-weight-bold">Select City</label>
                        <select class="form-control form-control-lg" id="state" name="state" required="">
                            <option value="">Select City</option>
                            @foreach($states as $state)
                                <option value="{{isset($state->code) ? $state->code : ''}}" {{isset($_REQUEST['state']) ? (($_REQUEST['state'] == $state->code) ? 'selected="selected"' : '') : ''}}>{{isset($state->code) ? $state->name : ''}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 mb-3 align-self-center">
                    <button type="submit" class="btn btn-primary btn-lg py-3 w-100 mt-3">Search</button>
                </div>
            </form>
        </div>
    </div>

    @yield('content')

</main>
</body>
@include('theme.footer')
@stack('customJs')

</html>