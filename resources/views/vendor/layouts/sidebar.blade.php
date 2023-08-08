@php
use Carbon\Carbon;
use App\Models\User;
use App\Models\VendorCompanyProfile;
$vendor = User::select('fname', 'lname', 'email', 'id')->where('status',
'1')->where('id',Auth::user()->id)->with('userDetails')->first();
$vendorcompany = VendorCompanyProfile::select('*')->where('field_key',
'company_name')->where('user_id',Auth::user()->id)->get();
$vendorimage = VendorCompanyProfile::select('*')->where('field_key',
'company_logo')->where('user_id',Auth::user()->id)->get();
@endphp

@foreach ($vendorimage as $key => $item)
{{$company_logo = $item->field_value}}
@endforeach

<div class="sidebar">
	<div class="scrollbar-inner sidebar-wrapper">
		<div class="user">
			<div class="photo">
				<img src="@if(isset($company_logo)){{asset($company_logo )}}@else{{asset('admin/img/profile.jpg')}}@endif" alt="Company Logo" width="36" class="img-circle" />
			</div>
			<div class="info">
				<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
					<span>
						@foreach ($vendorcompany as $key => $item)
						{{$item->field_value}}
						@endforeach
						<span class="user-level">Advertiser</span>
					</span>
				</a>
				<div class="clearfix"></div>

				<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
					<ul class="nav">
						{{-- <li>
							<a href="#profile">
								<span class="link-collapse">My Profile</span>
							</a>
						</li> --}}
						<li>
							<a href="{{route('vendor.profile')}}">
								<span class="link-collapse">View Profile</span>
							</a>
						</li>
{{--						<li>--}}
{{--							<a href="{{route('vendor.company_profile', Auth::user()->id)}}">--}}
{{--								<span class="link-collapse">Company Profile</span>--}}
{{--							</a>--}}
{{--						</li>--}}
						{{-- <li>
							<a href="#settings">
								<span class="link-collapse">Settings</span>
							</a>
						</li> --}}
					</ul>
				</div>
			</div>
		</div>
		<ul class="nav">
			{{-- @if (isset(Auth::user()->plan_id) && Auth::user()->plan_expiry_date > Carbon::now()) --}}
			<li class="nav-item {{request()->routeIs('vendor.profile') ? 'active' : ''}}">
				<a href="{{route('vendor.profile')}}">
					<i class="la la-user"></i>
					<p>Profile</p>
				</a>
			</li>
{{--			<li class="nav-item">--}}
{{--				<a href="{{url('advertiser/company-profile')}}">--}}
{{--					<i class="la la-user"></i>--}}
{{--					<p>Company Profile</p>--}}
{{--					<!-- <span class="badge badge-count">5</span> -->--}}
{{--				</a>--}}
{{--			</li>--}}
			<li class="nav-item {{request()->routeIs('vendor.deals.index') ? 'active' : ''}}">
				<a href="{{ route('vendor.deals.index') }}">
					<i class="la la-user"></i>
					<p>My Deals</p>
				</a>
			</li>

			<li class="nav-item {{request()->routeIs('plan.pricing') ? 'active' : ''}} ">
				<a href="{{route('plan.pricing')}}">
					<i class="la la-dollar"></i>
					<p>Subscription</p>
				</a>
			</li>
			<li class="nav-item {{request()->routeIs('vendor.deals.viewed') ? 'active' : ''}}">
				<a href="{{route('vendor.deals.viewed')}}">
					<i class="la la-eye"></i>
					<p>Reports</p>
				</a>
			</li>


{{--			<li class="nav-item {{request()->routeIs('vendor-invoice.index') ? 'active' : ''}}">--}}
{{--				<a href="{{route('vendor-invoice.index')}}">--}}
{{--					<i class="la la-file"></i>--}}
{{--					<p>Invoice</p>--}}
{{--				</a>--}}
{{--			</li>--}}



			<li class="nav-item {{request()->routeIs('vendor.deal-view-by-users') ? 'active' : ''}}">
				<a href="{{route('vendor.deal-view-by-users')}}">
					<i class="la la-info-circle"></i>
					<p>Save Deals</p>
					<!-- <span class="badge badge-count">5</span> -->
				</a>
			</li>



			<li class="nav-item {{request()->routeIs('vendor.contact_vendor.index') ? 'active' : ''}}">
				<a href="{{route('vendor.contact_vendor.index')}}">
					<i class="la la-envelope"></i>
					<p>Customer Query(s)</p>
					<!-- <span class="badge badge-count">5</span> -->
				</a>
			</li>



			<li class="nav-item ">
				<a href="{{ route('vendor.logout') }}">
					<i class="la la-user-times"></i>
					<p>Logout</p>
				</a>
			</li>
			{{-- @else
			<li class="nav-item">
				<a href="{{route('plan.pricing')}}">
					<i class="la la-dollar"></i>
					<p>Billing</p>
				</a>
			</li>
			@endif --}}
		</ul>
	</div>
</div>