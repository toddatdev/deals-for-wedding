<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DynamicMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use URL;
use App;
use App\Http\Controllers\NotificationController;
use Auth;
use file;
use Session;
use Illuminate\Support\Facades\Response;
use DB;
use Carbon\Carbon;
use App\Models\Billing;
use App\Models\User;
use App\Models\Deals;
use App\Models\DealViewed;
use App\Models\Category;
use App\Models\ContactVendorDeal;
use App\Models\UserDetails;
use App\Models\State;
use App\Models\CompanyForm;
use App\Models\VendorCompanyProfile;

class VendorController extends Controller
{


    protected $validationRules = [ 
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:8'
    ];

    protected $registerValidationRules = [
        'fname' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'g-recaptcha-response' => ['required'],
    ];

    protected $redirectTo = 'advertiser/login';

    public function index()
    {


        $deals = Deals::select('id')->where('user_id', Auth::user()->id)->get();
        $countCart = Cart::select('id')->where('user_id', Auth::user()->id)->get();

//        $dealViews = DealViewed::where('user_id', Auth::user()->id)->with('deals')->get();

//        dd($dealViews);
//
//        $deal_view_count = count($dealViews);

        $deal_count = count($deals) + count($countCart);

//        dd($deal_count);

        $category_count = Category::where('user_id', Auth::user()->id)->get()->count();

        $state_count = State::where('user_id', Auth::user()->id)->get()->count();

        $deal_query_count = ContactVendorDeal::with('user', 'deal')
            ->whereHas('deal', function ($q) use ($deals) {
                $q->whereIn('deal_id', $deals);
            })->get()->count();

        $vendorQuery = ContactVendorDeal::where('user_id',Auth::user()->id)->get();


        $advertiserDeals = Deals::where('user_id', Auth::user()->id)->get();

        $dealViews = [];


        foreach ($advertiserDeals as $adDeals){

            $SaveDeals = DealViewed::where('deal_id', $adDeals->id)->get();

            foreach ($SaveDeals as $sd){

                if ($sd->deal_id == $adDeals->id){

                    $dealViews[] = $sd;

                }
            }

        }



        $countReport = ContactVendorDeal::all();
        $dunamic_notification = DynamicMessage::get();
        $success_plan_purchase = $dunamic_notification[0]->success_subscription_message;

        $discounts = Billing::where('status', '1')->get();
        //if (isset(Auth::user()->plan_id) && Auth::user()->plan_expiry_date > Carbon::now()){

            return view('vendor.index', compact( 'category_count', 'deal_query_count', 'state_count','deal_count','dealViews', 'success_plan_purchase'));
       // }
        //else {
            //return view('vendor.pricing',compact('discounts'));
        //}
    }

    public function login()
    {
        return view('vendor.login');
    }

    public function login_post(Request $request)
    {
        //dd($request->all());
        $validation = Validator::make($request->all(), $this->validationRules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard()->attempt($credentials)) {
            if (Auth::guard()->user()->role == '3') {
                Session(['signedInAsAdmin' => 'admin']);

                return redirect()->route('vendor.dashboard');
            }
        } else {
            return back()->withError('Sorry, Your credentials do not match with our records.')->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flash('success', 'You have successfully logged out.');
        return redirect('/advertiser/login');
    }

    public function register()
    {
        return view('vendor.register');
    }

    public function all_notifications ()
    {
        $user = User::find(Auth::user()->id);
        $notifications = $user->notifications;
        return view('vendor.notifications', compact('user', 'notifications'));
    }

    public function register_post(Request $request)
    {
        $validation = Validator::make($request->all(), $this->registerValidationRules);
        if ($validation->fails()) {
            // dd($validation->errors());
            return redirect()->back()->withErrors($validation->errors());
        }

        try {
            $user = User::create([
                'fname'    => $request->fname,
                'lname'    => $request->lname,
                'email'    => $request->email,
                'role'     => '3', //user=2;admin=1;vendor=3
                'status'     => '1', //active=1;inactive=0
                'free_deal'     => null,
                'password' => Hash::make($request->password),
            ]);

            UserDetails::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'company' => $request->company
            ]);

//            $data = array();
//            $data['user_id'] = $user->id;
//            $data['field_key'] = 'company_name';
//            $data['field_value'] = $request->company;
//            VendorCompanyProfile::create($data);
//            $data1 = array();
//            $data1['user_id'] = $user->id;
//            $data1['field_key'] = 'contacts_name';
//            $data1['field_value'] = $request->fname;
//            VendorCompanyProfile::create($data1);
//            $data2 = array();
//            $data2['user_id'] = $user->id;
//            $data2['field_key'] = 'contacts_phone_number';
//            $data2['field_value'] = $request->phone;
//            VendorCompanyProfile::create($data2);
//            $data3 = array();
//            $data3['user_id'] = $user->id;
//            $data3['field_key'] = 'contacts_email_address';
//            $data3['field_value'] = $request->email;
//            VendorCompanyProfile::create($data3);


            $data = array();
            $data['user_id'] = $user->id;
            $data['field_key'] = 'company_name';
            $data['field_value'] = $request->company;
            $data['status'] = 1;
            VendorCompanyProfile::create($data);
            $data1 = array();
            $data1['user_id'] = $user->id;
            $data1['field_key'] = 'contacts_name';
            $data1['field_value'] = $request->fname;
            $data1['status'] = 1;
            VendorCompanyProfile::create($data1);
            $data2 = array();
            $data2['user_id'] = $user->id;
            $data2['field_key'] = 'contacts_phone_number';
            $data2['field_value'] = $request->phone;
            $data2['status'] = 1;
            VendorCompanyProfile::create($data2);
            $data3 = array();
            $data3['user_id'] = $user->id;
            $data3['field_key'] = 'contacts_email_address';
            $data3['field_value'] = $request->email;
            $data3['status'] = 1;
            VendorCompanyProfile::create($data3);
            $data4 = array();
            $data4['user_id'] = $user->id;
            $data4['field_key'] = 'contacts_mailings_address';
            $data4['field_value'] = NULL;
            $data4['status'] = 1;
            VendorCompanyProfile::create($data4);
            $data5 = array();
            $data5['user_id'] = $user->id;
            $data5['field_key'] = 'company_bio';
            $data5['field_value'] = NULL;
            $data5['status'] = 1;
            VendorCompanyProfile::create($data5);
            $data6 = array();
            $data6['user_id'] = $user->id;
            $data6['field_key'] = 'company_website_url';
            $data6['field_value'] = NULL;
            $data6['status'] = 1;
            VendorCompanyProfile::create($data6);
            $data7 = array();
            $data7['user_id'] = $user->id;
            $data7['field_key'] = 'company_facebook_url';
            $data7['field_value'] = NULL;
            $data7['status'] = 1;
            VendorCompanyProfile::create($data7);
            $data8 = array();
            $data8['user_id'] = $user->id;
            $data8['field_key'] = 'company_instagram_url';
            $data8['field_value'] = NULL;
            $data8['status'] = 1;
            VendorCompanyProfile::create($data8);
            $data9 = array();
            $data9['user_id'] = $user->id;
            $data9['field_key'] = 'company_logo';
            $data9['field_value'] = NULL;
            $data9['status'] = 0;
            VendorCompanyProfile::create($data9);



            $advertiser = $user->id;
            NotificationController::advertiser_registration_notify($advertiser);
            Session::flash('success', 'You have successfully registered with us. Please login..');
            return redirect()->route('vendor.login');
        } catch (\Throwable $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function company_profile()
    {

        $fields = CompanyForm::where('status', 1)->get();
        $vendor = User::where('role', '3')->where('id', Auth::user()->id)->first();
        return view('vendor.company_profile.form', compact('fields', 'vendor'));
    }

    public function update_company_profile(Request $request, $vendor_id)
    {

        try {
            $data = array();
            $requestData = $request->all();
            $isChecked = 0;

            if(isset($requestData['checkbox']) && gettype($requestData['checkbox']) == 'string'){
                unset($requestData['checkbox']);
                $isChecked = 1;
            }

            elseif(isset($requestData['checkbox'])){
                $isChecked = $requestData['checkbox'];
            }

            else {

            }
            unset($requestData['_token']);
            foreach ($requestData as $key => $input) {
                $company_logo = null;
                if ($request->hasFile($key)) {
                    $file = $input;
                    $fileName = (preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(' ', '_', $file->getClientOriginalName())));
                    $ext = $file->getClientOriginalExtension();
                    $completeFileName = time() . "!" . $fileName;
                    $path = 'uploads/vendor/';
                    $file->move(public_path($path), $completeFileName);
                    $company_logo = $path . $completeFileName;
                    $data['user_id'] = $vendor_id;
                    $data['field_key'] = $key;
                    $data['field_value'] = $company_logo;
                } else {
                    $data['user_id'] = $vendor_id;
                    $data['field_key'] = $key;
                    $data['field_value'] = $input;
                }
                $isExist = VendorCompanyProfile::where('user_id', $vendor_id)->where('field_key', $key)->first();
                if (!empty($isExist)) {
                    VendorCompanyProfile::where('user_id', $vendor_id)
                        ->where('field_key', $key)
                        ->update([
                            'field_value' => $data['field_value'],
                            'status' =>  $isChecked,
                        ]);
                } else {

                    VendorCompanyProfile::create($data);
                }
            }

            return redirect('advertiser/dashboard')->with('success', 'Company Profile has been updated');

        }
        catch (\Throwable $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function view_profile()
    {

        $fields = CompanyForm::where('status', 1)->get();

//        $vendor = User::where('role', '3')->where('id', Auth::user()->id)->first();

        $vendor = User::with('userDetails')->where('id', Auth::user()->id)->where('role', '3')->first();

        return view('vendor.profile.profile_form', compact('vendor','fields'));
    }

    public function update_profile(Request $request)
    {
        try {
            $image   = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $request->validate([
                    'image' => 'mimes:jpg,jpeg,png,gif',
                ]);

                $fileName = (preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(' ', '_', $file->getClientOriginalName())));
                $ext = $file->getClientOriginalExtension();
                $completeFileName = time() . "!" . $fileName;
                $path = 'uploads/vendor-image/';
                $file->move(public_path($path), $completeFileName);
                $image = $path . $completeFileName;
            }

            $updateUser = array(
                'fname'   => $request->fname,
                'lname'   => $request->lname,
                'email'   => $request->email,
            );

            if (isset($request->password) && !is_null($request->password)){

                $updateUser['password'] = Hash::make($request->password);

            }

            $details = array(
                'user_id'        => Auth::user()->id,
                'phone'        => $request->phone,
                'company'        => $request->company,
                'image'        => $image,
                'dob'          => date('Y-m-d', strtotime($request->dob)),
                'gender'       => $request->gender,
                'address'      => $request->address,
                'advertiser_bio' => $request->advertiser_bio,
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

            return redirect()->route('vendor.profile')->with('success', 'Your profile has been updated');
        } catch (\Throwable $e) {
            // dd($e->getMessage());
            return redirect()->route('vendor.profile')->with('error', $e->getMessage());
        }
    }
}
