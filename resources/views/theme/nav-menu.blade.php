<?php
$categories = App\Models\Category::where('status', 1)->get();
$states = App\Models\State::where('status', 1)->get();
?>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-1 py-lg-3">
    <a href="{{(Auth::check()) ? route('home.dashboard') : route('login')}}"><img src="{{ asset('front/images/user.png') }}" alt="Account" class="img-fluid account-img" /></a>
    <button style="position: relative;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand logo-area" href="/"><img src="{{ asset('front/images/logo.png') }}" alt="Deals for Weddings" class="mx-auto d-block img-fluid" />
    </a>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <ul class="navbar-nav ml-auto">

            <div class="dropdown show">

                <a class="btn btn-light dropdown-toggle" href="#"
                   role="button" id="dropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" style="font-size: 20px">

                    <b>oh hey,</b> {{(Auth::check()) ? (Auth::user()->fname.' '.Auth::user()->lname) : ''}}

                </a>

                <div class="dropdown-menu shadow border-0" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item text-dark font-weight-bold" href="{{(Auth::check()) ? route('home.dashboard') : route('login')}}">Account Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item font-weight-bold text-danger logout" href="{{ route('home.logout') }}">Logout</a>
                </div>

            </div>


{{--            <li class="nav-item d-none d-md-none d-lg-block d-xl-block">--}}

{{--                <div class="accountBox2">--}}
{{--                    <h6 style="margin-top:0; color:#fff;">oh hey, {{(Auth::check()) ? (Auth::user()->fname.' '.Auth::user()->lname) : ''}}--}}
{{--                        <br><a style="font-size:1.5em;" href="{{(Auth::check()) ? route('home.dashboard') : route('login')}}">your account</a></h6>--}}
{{--                    <img src="{{ asset('front/images/account.png') }}" class="mx-auto d-block img-fluid" alt="Account" />--}}
{{--                </div>--}}

{{--            </li>--}}



            <li class="nav-item d-block d-md-block d-lg-none d-xl-none mt-4">
                <a class="nav-link" href="#">
                    <form action="{{route('home.allDeals')}}" method="GET">
                        <div class="form-group">
                            <select class="form-control" id="category" name="category" required="">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{isset($category->slug) ? $category->slug : ''}}" {{isset($_REQUEST['category']) ? (($_REQUEST['category'] == $category->slug) ? 'selected="selected"' : '') : ''}}>{{isset($category->name) ? $category->name : ''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="state" name="state" required="">
                                <option value="">Select City</option>
                                @foreach($states as $state)
                                <option value="{{isset($state->code) ? $state->code : ''}}" {{isset($_REQUEST['state']) ? (($_REQUEST['state'] == $state->code) ? 'selected="selected"' : '') : ''}}>{{isset($state->name) ? $state->name : ''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </a>
            </li>


            <li class="nav-item d-block d-md-block d-lg-none d-xl-none mt-4">
                <a style="    background-color: #fff;
        color: #636680;
        font-weight: 400;
        display: inline-block;
        padding: 10px 35px;
        text-transform: uppercase;
        margin: 20px 0 0; margin-bottom: 1.5rem;" class="white-btn" href="{{(Auth::check()) ? route('home.dashboard') : route('login')}}">My Profile</a>
            </li>

        </ul>
    </div>
</nav>