<?php

namespace App\Http\Controllers;

use App\Mail\ViewDealMail;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Deals;
use App\Models\Category;
use App\Models\DealViewed;
use App\Models\State;
use App\Models\User;
use App\Models\ContactVendorDeal;
use App\Models\UserDealReview;
use App\Models\UserDeal;
use App\Models\UserDetails;
use App\Models\VendorCompanyProfile;
use Illuminate\Support\Facades\Mail;
use Spatie\Browsershot\Browsershot;
use URL;
use App;
use App\Models\DealViewed as ModelsDealviewed;
use App\Notifications\CustContact;
//use App\Notifications\DealViewed;
use App\Notifications\Reviews;
use Auth;
use file;
use Session;
use DB;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Redirect;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcome(){

        return view('front.welcome');
    }

    public function allDeals(Request $request)
    {
        $categories = Category::where('status', 1)->get();
        $states = State::where('status', 1)->get();
        if (isset($request->category) && isset($request->state)) {
            $category = Category::where('slug', $request->category)->first();
            $state = State::where('code', $request->state)->first();
            if (!empty($category) && !empty($state)) {
                $deals = Deals::with('user', 'category', 'state')
                    ->where('category_id', $category->id)
			        ->where('status', '1')->inRandomOrder()->get();                 
                return view('front.category', compact('deals', 'categories', 'states', 'category', 'state'));
            } else {
                abort(404);
            }
        } else {

            $deals = Deals::with('user', 'category', 'state')->where('status', 1)->inRandomOrder()->get();

            $user = User::with('userDetails')->where('id', Auth::user()->id)->first();

            return view('front.all_deals', compact('deals', 'categories', 'states', 'user'));
        }
    }

    public function viewDealByUser($id){

        $dealDetailsViewByUser = Deals::find($id);

//        dd($dealDetailsViewByUser);
        if (Auth::check()){

            Mail::to('support@dealsforweddings.com')->send(new ViewDealMail($dealDetailsViewByUser));

        }

//        dd($dealDetailsViewByUser);

        return redirect()->route('home.deal_detail',$dealDetailsViewByUser->slug);

    }

    public function deal_detail($slug)
    {
        $deal = Deals::with('category', 'state')->where('slug', $slug)->where('status', '1')->first();

        if (!empty($deal)) {
            $relative_deals = Deals::with('category', 'state')
                ->where('category_id', $deal->category_id)
                ->where('state_id', $deal->state_id)
                ->where('id', '!=', $deal->id)
		        ->where('status', '1')
                ->get();
            $categories = Category::where('status', 1)->get();
            $states = State::where('status', 1)->get();
            $user = User::with('userDetails')->where('id', Auth::user()->id)->first();
            $reviews = UserDealReview::with('userDetails')->where('deal_id', $deal->id)->orderBy('created_at', 'DESC')->get()->take(5);
            $advertiser = User::with('vendorCompany')->where('users.id', $deal->user_id)->get()->first();
            return view('front.vendor', compact('deal', 'relative_deals', 'categories', 'states', 'user', 'reviews', 'advertiser'));
        } else {
            abort(404);
        }
    }
    public function deal_view(Request $request)
    {
        $countDealsTotals = DealViewed::where('user_id', Auth::user()->id)->where('deal_id', $request->deal_id)->count();
        if (empty($countDealsTotals)) {
            try {
                $contact = DealViewed::create([
                    'user_id' => $request->user_id,
                    'deal_id' => $request->deal_id,
                    'user_name' => $request->user_name,
                    'user_email' => $request->user_email,
                    'user_phone' => $request->user_phone,
                    'wedding_date' => $request->wedding_date,
                    'deal_name' => $request->deal_name,
                ]);
            } catch (\Exception $e) {
                \Log::error("deal viewed", [$e->getMessage()]);
                //dd( $e->getMessage());
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    }

    public function download_payment($id)
    {
        $deal = Payments::with('user')->where('id', $id)->first();
        if (!empty($deal)) {
            $pdf = PDF::loadView('emails.download_payment', compact('deal'));
            return $pdf->download($deal->user->fname.'.pdf');
        } else {
            abort(404);
        }
    }


    public function deal_download($slug)
    {
        $deal = Deals::with('category', 'state')->where('slug', $slug)->first();
        if (!empty($deal)) {
            $relative_deals = Deals::with('category', 'state')
                ->where('category_id', $deal->category_id)
                ->where('state_id', $deal->state_id)
                ->where('id', '!=', $deal->id)
                ->get();
            $categories = Category::where('status', 1)->get();
            $states = State::where('status', 1)->get();
            $user = User::with('userDetails')->where('id', Auth::user()->id)->first();
            $reviews = UserDealReview::where('deal_id', $deal->id)->get()->take(5);
            return view('front.deal_download', compact('deal', 'relative_deals', 'categories', 'states', 'user', 'reviews'));

            // {{-- $pdf = PDF::loadView('front.deal_download', compact('deal', 'relative_deals', 'categories', 'states', 'user', 'reviews'))->setPaper('a4', 'portrait');
            // return $pdf->download('invoice.pdf'); --}}
        } else {
            abort(404);
        }
    }
    public function deal_detail2($deal_id)
    {
        $deal = Deals::with('category', 'state')->where('id', $deal_id)->first();
        if (!empty($deal)) {
            $relative_deals = Deals::with('category', 'state')
                ->where('category_id', $deal->category_id)
                ->where('state_id', $deal->state_id)
                ->where('id', '!=', $deal->id)
		->where('status', '1')
                ->get();
            $categories = Category::where('status', 1)->get();
            $states = State::where('status', 1)->get();
            $user = User::with('userDetails')->where('id', Auth::user()->id)->first();
            $reviews = UserDealReview::where('deal_id', $deal->id)->get()->take(5);
            $advertiser = User::with('vendorCompany')->where('users.id', $deal->user_id)->get()->first();
            return view('front.vendor', compact('deal', 'relative_deals', 'categories', 'states', 'user', 'reviews', 'advertiser'));
        } else {
            abort(404);
        }
    }

    public function save_deal_delete($id)
    {
        UserDeal::where('id', $id)->delete();

        return redirect('/dashboard#my-deals')->with('success', 'Saved deal has been removed. !!');
    }

    public function contact_vendor(Request $request)
    {
        // dd($request->all());
        try {
            $contact = ContactVendorDeal::create([
                'user_id' => $request->user_id,
                'deal_id' => $request->deal_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'wedding_date' => $request->wedding_date,
                'message' => $request->message,
            ]);

            $authorid = $request->advertiser;
            $author = User::where('id', $authorid)->first();
            $author_name = $request->advertiser_name;
            $user = $request->user_name;
            $dealname = $request->deal_name;
            $urlto = route('vendor.contact_vendor.index');
            $dealviewdata = [
                'subject' => 'New Contact Request Submitted',
                'greeting' => 'Hello' . ' ' . $author_name,
                'body' => 'Your Received a contact request from ' . $user,
                'url' => url($urlto),
                'text' => 'View Details!',
                'notifyto' => $author
            ];
            $author->notify(new CustContact($dealviewdata));
            return response()->json(['status' => 'success', 'message' => 'Query has been saved successfully.']);
        } catch (\Throwable $e) {
            //dd( $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Please Enter valid values']);
        }
    }

    public function send_review(Request $request)
    {
        // dd($request->all());
        try {
            $review = UserDealReview::create([
                'user_id' => $request->user_id,
                'deal_id' => $request->deal_id,
                'name' => $request->name,
                'email' => $request->email,
                'title' => $request->title,
                'message' => $request->message,
            ]);
            $authorid = $request->advertiser;
            $author = User::where('id', $authorid)->first();
            $author_name = $request->advertiser_name;
            $user = $request->user_name;
            $dealname = $request->deal_name;
            $urlto = route('reviews.index');
            $dealviewdata = [
                'subject' => $dealname . ' has got a new review!',
                'greeting' => 'Hello' . ' ' . $author_name,
                'body' => 'Your Deal ' . $dealname . ' reviewed by ' . $user,
                'url' => url($urlto),
                'text' => 'View Details!',
                'notifyto' => $author
            ];
            $author->notify(new Reviews($dealviewdata));
            return response()->json(['status' => 'success', 'message' => 'Review has been saved successfully.']);
        } catch (\Throwable $e) {
            //dd( $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function dreamTeam()
    {
        $categories = Category::where('status', 1)->get();
        $states = State::where('status', 1)->get();
        return view('front.dream-team', compact('categories', 'states'));
    }

    public function dashboard()
    {
        $user_details = User::select('*')
            ->with('userDetails')
            ->where('id', Auth::user()->id)
            ->first();
        $userDeals   = UserDeal::with('deal')->where('user_id', Auth::user()->id)->get();
        // dd($userDeals);
        return view('front.dashboard', compact('user_details', 'userDeals'));
    }

    public function save_deal(Request $request)
    {
        $countDealsTotals = UserDeal::where('user_id', Auth::user()->id)->where('deal_id', $request->deal_id)->count();

        if (empty($countDealsTotals)) {

            try {
                $review = UserDeal::create([
                    'user_id' => Auth::user()->id,
                    'deal_id' => $request->deal_id,
                    'city' => $request->city,
                    'categories' => $request->category,
                    'price' => number_format($request->price, '2', '.', ''),
                ]);

                return response()->json(['status' => 'success', 'message' => 'Deal has been saved successfully.']);

            } catch (\Throwable $e) {
                //dd( $e->getMessage());
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {

            return response()->json(['status' => 'error', 'message' => 'You have all ready added for this deals.']);
        }
    }

    public function updateUserProfile(Request $request)
    {
        $postData    = $request->all();

        $userId      = $postData['id'];
        $updateUserDetails  = [];
        $updateUser = [];
        $image   = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $request->validate([
                'image' => 'mimes:jpg,jpeg,png,gif',
            ]);

            $fileName = (preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(' ', '_', $file->getClientOriginalName())));
            $ext = $file->getClientOriginalExtension();
            $completeFileName = time() . "!" . $fileName;
            $path = 'uploads/user-image/';
            $file->move(public_path($path), $completeFileName);
            $image = $path . $completeFileName;
        }
        $updateUser = array(
            'fname'   => $postData['fname'],
            'lname'   => $postData['lname'],
            'email'   => $postData['email'],
        );
        if (!empty($postData['password'])) {
            $updateUser['password'] = Hash::make($postData['password']);
        }

        $updateUserDetails = array(
            'phone'        => $postData['phone'],
            'image'        => $image,

            'gender'       => $postData['gender'],
            'address'      => $postData['address'],
            'wedding_date' => $postData['wedding_date'],
            'city'         => $postData['city'],
            'state'        => $postData['state'],
            'zip'          => $postData['zip_code'],
        );
        // dd($updateUserDetails);
        User::where('id', $userId)->update($updateUser);

        UserDetails::where('user_id', $userId)->update($updateUserDetails);

        return redirect('/dashboard')->with('success', 'User profile has been updated');
    }

    public function userLogout(Request $request)
    {
        Auth::logout();
        Session::flash('success', 'You have successfully logged out.');
        return redirect('/login');
    }

    public function print_deals($deal_id)
    {
        $deal = Deals::with('category', 'state')->where('id', $deal_id)->first(); 
        return view('front.print_deals', compact('deal'));
    }
}
