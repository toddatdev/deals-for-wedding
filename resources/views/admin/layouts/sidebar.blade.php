@php
use App\Models\User;
$adminDetails = User::select('fname', 'lname', 'email', 'id')->where('status', '1')->where('id',Auth::user()->id)->with('userDetails')->first();
@endphp
<div class="sidebar" style="overflow-x: hidden">
	<div style="width:300px !important;max-height: none !important;" class="scrollbar-inner sidebar-wrapper" >
		<div class="user">
			<div class="photo">
				@if(isset($adminDetails->userDetails->image))
				<img src="{{asset($adminDetails->userDetails->image)}}" alt="user-img" width="36" class="img-circle"><span>{{ $adminDetails->fname }} {{ $adminDetails->lname }}</span>
				@else
				<img src="{{asset('admin/img/profile.jpg')}}" alt="user-img" width="36" class="img-circle"><span>{{ $adminDetails->fname }} {{ $adminDetails->lname }}</span>
				@endif
			</div>
			<div class="info">
				<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
					<span>
						{{ $adminDetails->fname }} {{ $adminDetails->lname }}
						<span class="user-level">Administrator</span>
						<span class="caret"></span>
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
							<a href="{{route('admin.profile')}}">
								<span class="link-collapse">View Profile</span>
							</a>
						</li>
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
			<li class="nav-item {{request()->routeIs('admin.dashboard') ?'active' : ''}}">
				<a href="{{route('admin.dashboard')}}">
					<i class="la la-dashboard"></i>
					<p>Dashboard</p>
					<!-- <span class="badge badge-count">5</span> -->
				</a>
			</li>


			<li class="nav-item {{request()->routeIs('deals.peruser')  ? 'active': '' }}">
				<a class="" data-toggle="collapse" href="#reportsCollapseMenu" aria-expanded="true">
					<i class="la la-sort-amount-desc"></i>
					<p>Reports</p>
					<span class="caret"></span>
				</a>
				<div class="clearfix"></div>
				<div class="collapse in" id="reportsCollapseMenu" aria-expanded="true" style="">
					<ul class="nav">
{{--						<li>--}}
{{--							<a href="{{ route('deals.sold') }}">--}}
{{--								<span class="link-collapse">Saved Deals</span>--}}
{{--							</a>--}}
{{--						</li>--}}
						<li>
							<a href="{{ route('deals.peruser') }}">
								<span class="link-collapse">Deals Per User</span>
							</a>
						</li>

{{--						<li>--}}
{{--							<a href="{{ route('admin-invoice.index') }}">--}}
{{--								<span class="link-collapse">Invoices</span>--}}
{{--							</a>--}}
{{--						</li>--}}

					</ul>
				</div>
			</li>


			@php
				$paymentList = request()->routeIs('plan.index') || request()->routeIs('plan.additional') || request()->routeIs('discount.index') || request()->routeIs('vendor.payment')
			@endphp

			<li class="nav-item {{$paymentList ? 'active' : ''}}">
				<a class="" data-toggle="collapse" href="#paymentsCollapseMenu" aria-expanded="true">
					<i class="la la-cc-paypal"></i>
					<p>Payment & Pricing</p>
					<span class="caret"></span>
				</a>
				<div class="clearfix"></div>
				<div class="collapse in" id="paymentsCollapseMenu" aria-expanded="true" style="">
					<ul class="nav">
						<li>
							<a href="{{ route('plan.index') }}">
								<span class="link-collapse">Pricing Plans</span>
							</a>
						</li>
						<li>
							<a href="{{ route('plan.additional') }}">
								<span class="link-collapse">Additional Pricing</span>
							</a>
						</li>
						<li>
							<a href="{{ route('discount.index') }}">
								<span class="link-collapse">Discounts</span>
							</a>
						</li>
						<li>
							<a href="{{ route('vendor.payment') }}">
								<span class="link-collapse">Received Payments</span>
							</a>
						</li>
					</ul>
				</div>
			</li>


			@php
				$userList = request()->routeIs('admin.admin-list') || request()->routeIs('admin.user-list') || request()->routeIs('admin.advertiser-list')
			@endphp

			<li class="nav-item {{$userList ? 'active' : ''}}">
				<a class="" data-toggle="collapse" href="#userCollapseMenu" aria-expanded="true">
					<i class="la la-user"></i>
					<p>User Management</p>
					<span class="caret"></span>
				</a>
				<div class="clearfix"></div>
				<div class="collapse in" id="userCollapseMenu" aria-expanded="true" style="">
					<ul class="nav">
						<li>
							<a href="{{ route('admin.admin-list') }}">
								<span class="link-collapse">Admin List</span>
							</a>
						</li>

						<li>
							<a href="{{ route('admin.user-list') }}">
								<span class="link-collapse">Users List</span>
							</a>
						</li>
						<li>
							<a href="{{ route('admin.advertiser-list') }}">
								<span class="link-collapse">Advertisers List</span>
							</a>
						</li>
					</ul>
				</div>
			</li>

			@php
				$dealsManagemnt = request()->routeIs('categories.index') || request()->routeIs('states.index') || request()->routeIs('deals.index') || request()->routeIs('contact_vendor.index')
			@endphp

			<li class="nav-item {{$dealsManagemnt ? 'active' : ''}}">
				<a data-toggle="collapse" href="#dealsCollapseMenu" aria-expanded="true">
					<i class="la la-user"></i>
					<p>Deals Management</p>
					<span class="caret"></span>
				</a>
				<div class="clearfix"></div>
				<div class="collapse in" id="dealsCollapseMenu" aria-expanded="true" style="">
					<ul class="nav">
						<li>
							<a href="{{ route('categories.index') }}">
								<span class="link-collapse">Category List</span>
							</a>
						</li>
						<li>
							<a href="{{ route('states.index') }}">
								<span class="link-collapse">Cities List</span>
							</a>
						</li>
						<li>
							<a href="{{ route('deals.index') }}">
								<span class="link-collapse">Deals List</span>
							</a>
						</li>

						<li>
							<a href="{{ route('admin.cart-list') }}">
								<span class="link-collapse">Cart List</span>
							</a>
						</li>


{{--						<li>--}}
{{--							<a href="{{ route('adminreviews.index') }}">--}}
{{--								<span class="link-collapse">Deal Reviews</span>--}}
{{--							</a>--}}
{{--						</li>--}}
						<li>
							<a href="{{ route('contact_vendor.index') }}">
								<span class="link-collapse">Contact Submissions</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
{{--			<li class="nav-item">--}}
{{--				<a href="{{route('admin.company_profile')}}">--}}
{{--					<i class="la la-at"></i>--}}
{{--					<p>Company Profiles</p>--}}
{{--					<!-- <span class="badge badge-count">5</span> -->--}}
{{--				</a>--}}
{{--			</li>--}}
			<li class="nav-item {{request()->routeIs('email.index')  ? 'active': '' }}">
				<a href="{{route('email.index')}}">
					<i class="la la-at"></i>
					<p>Email Notifications</p>
					<!-- <span class="badge badge-count">5</span> -->
				</a>
			</li>



			@php
				$websiteManagemnt = request()->routeIs('page.privacy_policy') || request()->routeIs('page.about_us') || request()->routeIs('faqs.index') || request()->routeIs('page.term_conditions')
			@endphp

			<li class="nav-item {{$websiteManagemnt ? 'active' : ''}}">
				<a class="" data-toggle="collapse" href="#pageCollapseMenu" aria-expanded="true">
					<i class="la la-user"></i>
					<p>Website Management</p>
					<span class="caret"></span>
				</a>
				<div class="clearfix"></div>
				<div class="collapse in" id="pageCollapseMenu" aria-expanded="true" style="">
					<ul class="nav">
						<li>
							<a href="{{ route('page.privacy_policy') }}">
								<span class="link-collapse">Privacy Policy</span>
							</a>
						</li>
						<li>
							<a href="{{ route('page.about_us') }}">
								<span class="link-collapse">About Us</span>
							</a>
						</li>
						<li>
							<a href="{{ route('faqs.index') }}">
								<span class="link-collapse">FAQ List</span>
							</a>
						</li>
						<li>
							<a href="{{ route('page.term_conditions') }}">
								<span class="link-collapse">Term & Conditions</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="" data-toggle="collapse" href="#blogsCollapseMenu" aria-expanded="true">
								<p>Blog Management</p>
								<span class="caret"></span>
							</a>
							<div class="clearfix"></div>
							<div class="collapse in" id="blogsCollapseMenu" aria-expanded="true" style="">
								<ul class="nav">
									<li>
										<a href="{{ url('admin/blog-category') }}">
											<span class="link-collapse">Categories</span>
										</a>
									</li>
									<li>
										<a href="{{ url('admin/blog') }}">
											<span class="link-collapse">Posts</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</li>


			@php
				$companyFormManagemnt = request()->routeIs('company_form.index') || request()->routeIs('company_form.create')
			@endphp

			<li class="nav-item {{$companyFormManagemnt ? 'active': ''}}">
				<a class="" data-toggle="collapse" href="#companyFormCollapseMenu" aria-expanded="true">
					<i class="la la-user"></i>
					<p>Company Form Management</p>
					<span class="caret"></span>
				</a>

				<div class="clearfix"></div>
				<div class="collapse in" id="companyFormCollapseMenu" aria-expanded="true" style="">
					<ul class="nav">
						<li>
							<a href="{{ route('company_form.index') }}">
								<span class="link-collapse">All Fields</span>
							</a>
						</li>
						<li>
							<a href="{{ route('company_form.create') }}">
								<span class="link-collapse">Add Field</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
            <li class="nav-item {{request()->routeIs('admin.messages')  ? 'active': '' }}">
				<a href="{{route('admin.messages')}}">
					<i class="la la-envelope"></i>
					<p>Dynamic Modifications</p>
					
				</a>
				<div class="clearfix"></div>
			</li>

			@php
				$faqs = request()->routeIs('faqs.index') || request()->routeIs('faqs.create')
			@endphp

			<li class="nav-item {{$faqs ? 'active' : ''}}">
				<a class="" data-toggle="collapse" href="#faqCollapseMenu" aria-expanded="true">
					<i class="la la-user"></i>
					<p>FAQs Management</p>
					<span class="caret"></span>
				</a>
				<div class="clearfix"></div>
				<div class="collapse in" id="faqCollapseMenu" aria-expanded="true" style="">
					<ul class="nav">
						<li>
							<a href="{{ route('faqs.index') }}">
								<span class="link-collapse">All FAQs</span>
							</a>
						</li>
						<li>
							<a href="{{ route('faqs.create') }}">
								<span class="link-collapse">Add FAQ</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav-item {{request()->routeIs('admin.settings')  ? 'active': '' }}">
				<a href="{{route('admin.settings')}}">
					<i class="la la-gear"></i>
					<p>Settings</p>
					
				</a>
				<div class="clearfix"></div>
			</li>




		</ul>
	</div>
</div>