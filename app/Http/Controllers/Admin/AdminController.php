<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdditionalPricing;
use App\Models\Billing;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use URL;
use App;
use App\Exports\CompanyExport;
use Auth;
use file;
use Session;
use Illuminate\Support\Facades\Response;
use DB;
use App\Models\User;
use App\Models\State;
use App\Models\Deals;
use App\Models\Category;
use App\Models\CompanyForm;
use App\Models\ContactVendorDeal;
use App\Models\DealViewed;
use App\Models\EmailCopy;
use App\Models\Settings;
use App\Models\Tasks;
use App\Models\UserDeal;
use App\Models\UserDetails;
use App\Models\DynamicMessage;
use App\Models\VendorCompanyProfile;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{


	protected $validationRules = [
		'email' => 'required|email|exists:users,email',
		'password' => 'required|min:8'
	];

	protected $registerValidationRules = [
		'fname' => ['required', 'string', 'max:255'],
		'lname' => ['required', 'string', 'max:255'],
		'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
		'password' => ['required', 'string', 'min:8'],
	];

	protected $redirectTo = '/admin/login';

	public function index()
	{
		$deal_count = Deals::get()->count();
		$user_count = User::get()->count();
		$admin_count = User::where('role', 1)->get();
		$category_count = Category::get()->count();
		$deal_query_count = ContactVendorDeal::get()->count();
		$tasks = Tasks::get();
		return view('admin.index', compact('deal_count', 'user_count', 'category_count', 'deal_query_count', 'tasks'));
	}

	public function login()
	{
		return view('admin.login');
	}

	public function adminLoginPost(Request $request)
	{


		$validation = Validator::make($request->all(), $this->validationRules);
		if ($validation->fails()) {
			return redirect()->back()->withErrors($validation->errors());
		}

		$credentials = $request->only('email', 'password');

		if (Auth::guard()->attempt($credentials)) {
			if (Auth::guard()->user()->role == '1') {
				Session(['signedInAsAdmin' => 'admin']);

				return redirect()->route('admin.dashboard');
			}
		} else {
			return back()->withError('Sorry, Your credentials do not match with our records.')->withInput();
		}
	}

	public function register()
	{
		return view('admin.register');
	}

	public function adminRegisterPost(Request $request)
	{
//        dd($request->all());

		$validation = Validator::make($request->all(), $this->registerValidationRules);
		if ($validation->fails()) {
			return redirect()->back()->withErrors($validation->errors());
		}

		try {
			$user = User::create([
				'fname'    => $request->fname,
				'lname'    => $request->lname,
				'email'    => $request->email,
				'role'     => 1, //user=2;admin=1
				'status'     => $request->status, //active=1;inactive=0
				'password' => Hash::make($request->password),
			]);

			Session::flash('success', 'New admin has been created successfully!!!');

			return redirect()->route('admin.admin-list');
		}
		catch (\Throwable $e)
        {
//            dd($e->getMessage());
			return back()->withError($e->getMessage())->withInput();

		}
	}
	public function userList()
	{
		$userDetails = User::select('*')->with('userDetails')->where('role', '2')->get();
		return view('admin.users.user-list', compact('userDetails'));
	}

	public function adminList(){

        $adminDetails = User::select('*')->with('userDetails')->where('role', '1')->get();

	    return view('admin.admins.index',compact('adminDetails'));

    }

	public function advertiserList()
	{
		$userDetails = User::select('*')->with('userDetails')->where('role', '3')->get();
		$states = State::select('*')->get();
		$categories = Category::select('*')->get();
		return view('admin.advertiser.advertiser-list', compact('userDetails', 'states', 'categories'));
	}

	public function download_user_list(Request $request)
	{

		if ($request->filter_data == 'Past') {

			$date = date('Y-m-d');
			$userDetails = User::select('*')->with('userDetails')->join('user_details', 'user_details.user_id', '=', 'users.id')->where('users.role', '2')->where('user_details.wedding_date', '<', $date)->get();
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=past_user_list.csv');
			$output = fopen("php://output", "w");
			fputcsv($output, array('Name', 'Email', 'number', 'Wedding Date'));

			foreach ($userDetails as $dalaList) {

				$dalaLists = array(
					'Name'          => $dalaList->fname . ' ' . $dalaList->lname,
					'Email'         => $dalaList->email,
					'number'        => $dalaList->phone,
					'wedding_date'  => $dalaList->wedding_date,
				);
				fputcsv($output, $dalaLists);
			}
			fclose($output);
			exit;
		}
		if ($request->filter_data == 'Future') {

			$date = date('Y-m-d');
			$userDetails = User::select('*')->with('userDetails')->join('user_details', 'user_details.user_id', '=', 'users.id')->where('users.role', '2')->where('user_details.wedding_date', '>', $date)->get();
			//return view('admin.users.user-download', compact('userDetails'));
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=future_user_list.csv');
			$output = fopen("php://output", "w");
			fputcsv($output, array('Name', 'Email', 'number', 'Wedding Date'));

			foreach ($userDetails as $dalaList) {

				$dalaLists = array(
					'Name'          => $dalaList->fname . ' ' . $dalaList->lname,
					'Email'         => $dalaList->email,
					'number'        => $dalaList->phone,
					'wedding_date'  => $dalaList->wedding_date,
				);
				fputcsv($output, $dalaLists);
			}
			fclose($output);
			exit;
		}
		if ($request->filter_data == 'All') {

			$getCurrentDate = date('Y-m-d');
			$userDetails = User::select('*')->with('userDetails')->where('role', '2')->get();
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=user_list.csv');
			$output = fopen("php://output", "w");
			fputcsv($output, array('Name', 'Email', 'number', 'Wedding Date'));

			foreach ($userDetails as $dalaList) {

				$dalaLists = array(
					'Name'          => $dalaList->fname . ' ' . $dalaList->lname,
					'Email'         => $dalaList->email,
					'number'        => $dalaList->userDetails->phone,
					'wedding_date'  => $dalaList->userDetails->wedding_date,
				);
				fputcsv($output, $dalaLists);
			}
			fclose($output);
			exit;
		}
	}
	public function all_notifications ()
    {
        $user = User::find(Auth::user()->id);
        $notifications = $user->notifications;
        return view('admin.notifications', compact('user', 'notifications'));
    }
	public function download_deals(Request $request)
	{
			$date = date('Y-m-d');
			$userDetails = Deals::with('user', 'category', 'state')->get();
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=Deal_Lists.csv');
			$output = fopen("php://output", "w");
			fputcsv($output, array('ID', 'Title', 'Advertiser', 'Slug', 'Category', 'City', 'Description', 'Teaser Text', 'Price', 'Offered Price', 'Discount Code', 'Expiry Date', 'Status'));

			foreach ($userDetails as $dalaList) {

				$dalaLists = array(
					'ID'          => $dalaList->id,
					'Title'         => $dalaList->title,
					'Advertiser'        => $dalaList->user->fname . " " . $dalaList->user->lname,
					'Slug'  => $dalaList->slug,
					'Category'  => $dalaList->category->name,
					'City'  => $dalaList->state->name,
					'Description'  => $dalaList->description,
					'Teaser Text'  => $dalaList->teaser_text,
					'Price'  => $dalaList->price,
					'Offered Price'  => $dalaList->offer_price,
					'Discount Code'  => $dalaList->discountcode,
					'Expiry Date'  => $dalaList->expiration_date,
					'Status'  => $dalaList->status,
				);
				fputcsv($output, $dalaLists);
			}
			fclose($output);
			exit;
	}

	public function addUsers()
	{
		return view('admin.users.add-user');
	}
	public function addAdvertiser()
	{
		return view('admin.advertiser.add-advertiser');
	}

	public function cartList(){

        $discounts = Billing::where('status', '1')
            ->get();

//        $userPlanID = Billing::where('id', auth()->user()->plan_id)->first();

        $deals = Cart::whereHas('user')->get();
        $cities = State::get();
        $additionalCharges = AdditionalPricing::first();
        // dd($deals->toArray());
        return view('admin.cart.index', compact('deals', 'cities','additionalCharges'));

    }

	public function saveUsers(Request $request)
	{
		$uploadPath = public_path() . '/images/userImage/';

		$this->validate($request, [
			'fname'    => ['required'],
			'lname'    => ['required'],
			'email'    => ['required', 'email', 'unique:users'],
			'password' => ['required'],
			'phone'    => ['required', 'unique:user_details', 'max:13'],
		]);
		$user        = new User;
		$userDetails = new UserDetails;

		$user->fname    = $request->fname;
		$user->lname    = $request->lname;
		$user->email    = $request->email;
		$user->password = Hash::make($request->password);
		$user->role     = $request->role;
		$user->save();
		$lastInsertId   = $user->id;

		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$request->validate([
				'image' => 'required|mimes:jpg,jpeg,png,gif',
			]);
			$fileName = time() . rand() . '.' . $file->getClientOriginalExtension();
			$file->move($uploadPath, $fileName);
			$userDetails->image = $fileName;
		}

		$userDetails->user_id  = $lastInsertId;
		$userDetails->phone    = $request->phone;
		$userDetails->dob      = $request->dob;
		$userDetails->gender   = $request->gender;
		$userDetails->address  = $request->address;
		$userDetails->save();
		return redirect('/admin/user-list')->with('success', 'User has been added successfully!!');
	}
	public function saveAdvertiser(Request $request)
	{
		$uploadPath = public_path() . '/images/userImage/';

		$this->validate($request, [
			'fname'    => ['required'],
			'lname'    => ['required'],
			'email'    => ['required', 'email', 'unique:users'],
			'password' => ['required'],
			'phone'    => ['required', 'unique:user_details', 'max:13'],
		]);
		$user        = new User;
		$userDetails = new UserDetails;

		$user->fname    = $request->fname;
		$user->lname    = $request->lname;
		$user->email    = $request->email;
		$user->password = Hash::make($request->password);
		$user->role     = $request->role;
		$user->save();
		$lastInsertId   = $user->id;

		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$request->validate([
				'image' => 'required|mimes:jpg,jpeg,png,gif',
			]);
			$fileName = time() . rand() . '.' . $file->getClientOriginalExtension();
			$file->move($uploadPath, $fileName);
			$userDetails->image = $fileName;
		}

		$userDetails->user_id  = $lastInsertId;
		$userDetails->phone    = $request->phone;
		$userDetails->dob      = $request->dob;
		$userDetails->gender   = $request->gender;
		$userDetails->address  = $request->address;
		$userDetails->save();
		return redirect('/admin/advertiser-list')->with('success', 'Advertiser has been added successfully!!');
	}

    public function updateAdmin(Request $request, $id){
         $request->validate([
             'fname' => ['required', 'string', 'max:255'],
             'lname' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'email', 'max:255'],
         ]);

        $admins = User::findOrFail($id);

        if (!empty($request['password'])){

            $request['password'] = Hash::make($request['password']);
        }

        else{

            unset($request['password']);

        }

        $admins->update($request->all());

        Session::flash('success', 'admin has been Updated successfully!!!');

        return redirect()->route('admin.admin-list');


    }

	public function updateUsers($id, Request $request)
	{

		$uploadPath     = public_path() . '/images/userImage/';

		$userDetailData = [];

		$userData       = [];

		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$request->validate([
				'image' => 'required|mimes:jpg,jpeg,png,gif',
			]);
			$fileName = time() . rand() . '.' . $file->getClientOriginalExtension();
			$file->move($uploadPath, $fileName);
			$userDetailData['image'] = $fileName;
		}

		if (!empty($request->input('password'))) {
			$userData['password'] = Hash::make($request->password);
		}

		$userData = array(
			'fname' => $request->fname,
			'lname' => $request->lname,
			'email' => $request->email,
		);

		$userDetailData = array(
			'phone'   => $request->phone,
			'wedding_date'     => Carbon::createFromFormat('m-d-Y',$request->wedding_date)->format('Y-m-d'),
			'address' => $request->address,
		);

		User::where('id', $id)->update($userData);

		UserDetails::where('user_id', $id)->update($userDetailData);

		return redirect('/admin/user-list')->with('success', 'User details has been updated');
	}


	public function updateAdvertiser($id, Request $request)
	{

		$uploadPath     = public_path() . '/images/userImage/';

		$userDetailData = [];

		$userData       = [];

		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$request->validate([
				'image' => 'required|mimes:jpg,jpeg,png,gif',
			]);
			$fileName = time() . rand() . '.' . $file->getClientOriginalExtension();
			$file->move($uploadPath, $fileName);
			$userDetailData['image'] = $fileName;
		}

		if (!empty($request->input('password'))) {
			$userData['password'] = Hash::make($request->password);
		}

		$userData = array(
			'fname' => $request->fname,
			'lname' => $request->lname,
			'email' => $request->email,
		);

		$userDetailData = array(
			'phone'   => $request->phone,
			'address' => $request->address,
		);

		User::where('id', $id)->update($userData);

		UserDetails::where('user_id', $id)->update($userDetailData);

		return redirect('/admin/advertiser-list')->with('success', 'Advertiser details has been updated');
	}

	public function editUsers($id)
	{
		$userDetails = User::select('*')->with('userDetails')->where('id', $id)->where('role', '2')->first();
		return view('admin.users.add-user', compact('userDetails'));
	}
	public function editAdvertiser($id)
	{
		$userDetails = User::select('*')->with('userDetails')->where('id', $id)->where('role', '3')->first();
		$fields = CompanyForm::where('status', 1)->get();
        $vendor = User::where('role', '3')->where('id', $id)->first();
		return view('admin.advertiser.add-advertiser', compact('userDetails', 'vendor', 'fields'));
	}

	public function showAdvertiserDealList($id)
	{

		$userDetails = User::select('*')->with('userDetails')->where('id', $id)->where('role', '3')->first();
        $currentAdviserDealList =  App\Models\Deals::where('user_id', $userDetails->id)->get();
        $cities = App\Models\State::get();

		return view('admin.advertiser.show-advertiser-deals', compact('userDetails', 'currentAdviserDealList','cities'));
	}


	public function deleteUsers($id)
	{
		User::where('id', $id)->delete();

		UserDetails::where('user_id', $id)->delete();

		return redirect('/admin/user-list')->with('success', 'User record has been deleted !!');
	}

    public function deleteAdmin($id)
    {

        User::find($id)->delete();

        Session::flash('success', 'Admin deleted successfully!!!');

        return redirect()->route('admin.admin-list');


        User::where('id', $id)->delete();

        UserDetails::where('user_id', $id)->delete();

        return redirect('/admin/user-list')->with('success', 'User record has been deleted !!');
    }

	public function deleteAdvertiser($id)
	{
		User::where('id', $id)->delete();

		UserDetails::where('user_id', $id)->delete();

		VendorCompanyProfile::where('user_id', $id)->delete();

		Deals::where('user_id', $id)->delete();

		return redirect('/admin/advertiser-list')->with('success', 'User record has been deleted !!');
	}

	public function view_profile()
	{
		$admin = User::with('userDetails')->where('id', Auth::user()->id)->first();
		return view('admin.profile.profile_form', compact('admin'));
	}

	public function update_profile(Request $request)
	{
		try {
			$image   = null;
			if ($request->hasFile('image')) {
				$file = $request->file('image');
				$request->validate([
					'image' => 'required|mimes:jpg,jpeg,png,gif',
				]);

				$fileName = (preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(' ', '_', $file->getClientOriginalName())));
				$ext = $file->getClientOriginalExtension();
				$completeFileName = time() . "!" . $fileName;
				$path = 'uploads/admin-image/';
				$file->move(public_path($path), $completeFileName);
				$image = $path . $completeFileName;
			}
			$updateUser = array(
				'fname'   => $request->fname,
				'lname'   => $request->lname,
				'email'   => $request->email,
			);

			$details = array(
				'user_id'        => Auth::user()->id,
				'phone'        => $request->phone,
				'image'        => $image,
				'dob'          => date('Y-m-d', strtotime($request->dob)),
				'gender'       => $request->gender,
				'address'      => $request->address,
				'wedding_date'      => null,
				'city'      => null,
				'state'      => null,
				'zip'      => null,
			);
			// dd($updateUserDetails);
			User::where('id', Auth::user()->id)->update($updateUser);
			$isUserData = UserDetails::where('user_id', Auth::user()->id)->first();
			// dd($isUserData);
			if (!empty($isUserData)) {
				UserDetails::where('user_id', Auth::user()->id)->update($details);
			} else {
				UserDetails::create($details);
			}

			return redirect()->route('admin.profile')->with('success', 'Your profile has been updated');
		} catch (\Throwable $e) {
			dd($e->getMessage());
		}
	}

	public function deal_view()
    {
		$market = State::where('status', '1')->get();
        $dealViews = UserDeal::with('deal')->get();
        return view('admin.deals.deal_sold', compact('dealViews', 'market'));
    }

	public function deal_viewf(Request $request)
    {
		$market = State::where('status', '1')->get();
		if($request->filter_data == '7days'){
			$dealViews = UserDeal::with('deal')->whereDate('created_at', '>', Carbon::now()->subDays(7))->get();
		}
		if($request->filter_data == 'onemonth'){
			$dealViews = UserDeal::with('deal')->whereDate('created_at', '>', Carbon::now()->subDays(30))->get();
		}
		if($request->filter_data == 'threemonth'){
			$dealViews = UserDeal::with('deal')->whereDate('created_at', '>', Carbon::now()->subDays(90))->get();
		}
		if(isset($request->market)){
			$dealViews = UserDeal::with('deal')->where('city', $request->market)->get();
		}
		if($request->filter_data == 'All'){
			$dealViews = UserDeal::with('deal')->get();
		}
        return view('admin.deals.deal_sold', compact('dealViews', 'market'));
		//return Carbon::now()->subDays(7);
    }

	public function per_user_deals(Request $request)
    {
		$dealViews = Deals::with('user')->get();

        return view('admin.deals.per_user_deals', compact('dealViews'));
    }
	public function per_user_dealsf(Request $request)
    {
		if($request->filter_data == '7days'){
			$dealViews = Deals::with('user')->whereDate('created_at', '>', Carbon::now()->subDays(7))->get();
		}
		if($request->filter_data == 'onemonth'){
			$dealViews = Deals::with('user')->whereDate('created_at', '>', Carbon::now()->subDays(30))->get();
		}
		if($request->filter_data == 'threemonth'){
			$dealViews = Deals::with('user')->whereDate('created_at', '>', Carbon::now()->subDays(90))->get();
		}
		if($request->filter_data == 'All'){
			$dealViews = Deals::with('user')->get();
		}
        return view('admin.deals.per_user_deals', compact('dealViews'));
		//return Carbon::now()->subDays(7);
    }
	public function vendor_payment()
    {
        $dealViews = Deals::with('user')->get();
        return view('admin.advertiser.advertiser_payments', compact('dealViews'));
    }
	public function email_index()
	{
		$emails = EmailCopy::where('id', 1)->first();
		return view('admin.emails.email_copy', compact('emails'));
	}
	public function settings()
	{
		$settings = Settings::where('id', 1)->first();
		return view('admin.profile.settings', compact('settings'));
	}

	public function settings_update(Request $request)
	{
		$settings = Settings::find(1);

		$settings->facebook = $request->facebook;
		$settings->twitter = $request->twitter;
		$settings->instagram = $request->instagram;
		$settings->save();
		return redirect()->route('admin.settings')->with('success', 'Your settings has been updated');
	}

	public function settings_password(Request $request)
	{
		$user = User::find(Auth::user()->id);
		if ($request->password == $request->confirm_password){
			$user->password = Hash::make($request->password);
			$user->save();
			return redirect()->route('admin.settings')->with('success', 'Your password has been updated');
		}
		else {
			return redirect()->route('admin.settings')->with('error', 'Passwords not matched.');
		}
	}

	public function email_update(Request $request)
	{
		$updateEmail = array(
			'new_user_reg'   => $request->new_user_reg,
			'new_advertiser_reg'   => $request->new_advertiser_reg,
			'new_deal_submit'   => $request->new_deal_submit,
		);
		$emails = EmailCopy::where('id', 1)->update($updateEmail);
		return redirect()->route('email.index')->with('success', 'Email copy texts has been updated');
	}

	public function messages()
	{

		$message = DynamicMessage::first();

		return view('admin.messages.message' , compact('message'));
	}

    public function postNewMessages(Request $request)
	{
        try {

            DynamicMessage::create($request->all());

            return redirect()->route('admin.messages')->with('success', 'Message Has Created');

        }catch (\Exception $exception){

            return redirect()->route('admin.messages')->with('error', 'There is an issue with your submission, please try again later. ');
        }

	}

	public function updateMessages(Request $request ,$id)
	{
	    DynamicMessage::findOrFail($id)->update($request->all());

        return redirect()->route('admin.messages')->with('success', 'Message has been updated successfully');
	}
}
