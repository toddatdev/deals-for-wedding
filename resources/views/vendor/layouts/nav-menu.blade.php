@php
    use App\Models\User;
    use App\Models\Deals;
    use App\Models\Cart;
    use App\Models\VendorCompanyProfile;

    $vendor = User::select('fname', 'lname', 'email', 'id')->where('status',
    '1')->where('id',Auth::user()->id)->with('userDetails')->first();
    $cart = Cart::where('user_id', Auth::user()->id)->get();
    $cartTotal = count($cart);

    $user = App\Models\User::find(Auth::user()->id);
    $notifycount = $user->unreadnotifications->count();
    $notifications = $user->unreadnotifications;
    $vendorimagenav = VendorCompanyProfile::select('*')->where('field_key','company_logo')->where('user_id',Auth::user()->id)->first();
@endphp
<style>
    .nav-item .img-circle {
        height: 40px;
        width: 40px;
        object-fit: cover;
    }
</style>
<div class="main-header">
    <div class="logo-header" style="background-color: #636680;">
        <div class="">
            <a target="_blank" href="{{route('home')}}" class="logo">
                <img src="{{asset('front/images/logo.png')}}" width="100%">
            </a>
        </div>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
    </div>
    <nav class="navbar navbar-header navbar-expand-lg">
        <div class="container-fluid">
            <form class="navbar-left navbar-form nav-search mr-md-3" action="" style="margin-bottom: 0">
                <div class="input-group">
                    <input type="text" placeholder="Search ..." class="form-control">
                    <div class="input-group-append">
						<span class="input-group-text">
							<i class="la la-search search-icon"></i>
						</span>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="{{route('vendor.cart')}}"><i
                                class="la la-shopping-cart"></i>
                        <span class="notification">{{$cartTotal}}</span>
                    </a>

                </li>
                {{-- <li class="nav-item dropdown hidden-caret">
                   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="la la-envelope"></i>
                   </a>
                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item" href="#">Action</a>
                       <a class="dropdown-item" href="#">Another action</a>
                       <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="#">Something else here</a>
                   </div>
               </li> --}}
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-bell"></i>
                        <span class="notification">{{$notifycount}}</span>
                    </a>
                    <ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
                        <li>
                            <div class="dropdown-title">You have {{$notifycount}} new notification</div>
                        </li>
                        <li>
                            <div class="notif-center">
                                @foreach ($notifications as $notification)
                                    <a id="notify_{{$notification->id}}" class="notifyaccess" href="javascript:;">
                                        <div style="width: 50px" class="notif-icon notif-primary"><i
                                                    class="la la-bell"></i></div>
                                        <div style="flex-basis: 95%" class="notif-content">
										<span class="block">
											{{$notification->data['body']}}
                                            {{-- <a href="{{route('notification.mark', $notification->id)}}" class="time">Mark as read!</a> --}}
										</span>
                                        </div>
                                    </a>
                                    <script>
                                        setTimeout(() => {

                                            $('#notify_{{$notification->id}}').click(function (e) {
                                                e.preventDefault();
                                                var id = "{{$notification->id}}";
                                                console.log('working');
                                                $.ajax({
                                                    type: 'get',
                                                    url: "{{route('notification.mark', $notification->id)}}",
                                                    success: function (response) {
                                                        console.log(response)
                                                        setTimeout(() => {

                                                            location.href = "{{$notification->data['url']}}";
                                                        }, 1000);
                                                    }
                                                })

                                            })
                                        }, 1500);
                                    </script>
                                @endforeach
                            </div>
                        </li>
                        <li>
                            <a class="see-all" href="{{route('vendor.notifications')}}"> <strong>See all
                                    notifications</strong> <i
                                        class="la la-angle-right"></i> </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        @if(isset($vendorimagenav->field_value))
                            <img src="{{asset($vendorimagenav->field_value)}}" width="36"
                                 class="img-circle"><span>{{ $vendor->fname ?? '' }} {{ $vendor->lname ?? '' }}</span>
                        @else
                            <img src="{{asset('admin/img/profile.jpg')}}" alt="user-img" width="36"
                                 class="img-circle"><span>{{ $vendor->fname }} {{ $vendor->lname }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <div class="user-box">
                                <div class="u-img">
                                    @if(isset($vendorimagenav->field_value))
                                        <img src="{{asset($vendorimagenav->field_value)}}" alt="user-img" width="36"
                                             class="">
                                    @else
                                        <img src="{{asset('admin/img/profile.jpg')}}" alt="user-img" width="36"
                                             class="">
                                    @endif
                                </div>
                                <div class="u-text">
                                    <h4>{{ $vendor->fname }} {{ $vendor->lname }}</h4>
                                    <p class="text-muted">{{ $vendor->email }}</p><a href="{{route('vendor.profile')}}"
                                                                                     class="btn btn-rounded btn-danger btn-sm">View
                                        Profile</a>
                                </div>
                            </div>
                        </li>
                        <div class="dropdown-divider"></div>
                        {{-- <a class="dropdown-item" href="#"><i class="ti-user"></i> My Profile</a>
                                        <a class="dropdown-item" href="#"><i class=""></i> My Balance</a>
                                        <a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"><i class="ti-settings"></i> Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </div>--}}
                        <a class="dropdown-item" href="{{ route('vendor.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="fa fa-power-off"></i> Logout</a>
                        <form id="logout-form" action="{{ route('vendor.logout') }}" method="get" class="d-none">
                            @csrf
                        </form>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
            </ul>
        </div>
    </nav>
</div>