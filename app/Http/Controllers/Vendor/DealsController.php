<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\DynamicMessage;
use Illuminate\Http\Request;
use App\Models\Deals;
use App\Models\User;
use App\Models\Category;
use App\Models\State;
use Illuminate\Support\Facades\Validator;
use URL;
use App;
use App\Models\AdditionalPricing;
use App\Models\Cart;
use App\Models\dealView;
use App\Models\DealViewed;
use App\Models\UserDeal;
use App\Models\UserDealReview;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StripePaymentController;
use Auth;
use file;
use Session;
use Illuminate\Support\Facades\Response;
use DB;

class DealsController extends Controller
{
    protected $validationRules = [
        'title' => 'required|string',
        'category_id' => 'required|numeric',
        'state_id' => 'required|numeric',
        'description' => 'required',
        'image' => 'mimes:jpeg,jpg,png,gif|required|max:8000',
        'price' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deals = Deals::with('user', 'category', 'state')->where('user_id', Auth::user()->id)->get();

        $discounts = Billing::where('status', '1')
            ->get();

        $userPlanID = Billing::where('id', auth()->user()->plan_id)->first();

        $cartData = Cart::with('user', 'category', 'state')->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->get();
        $cities = State::get();
        $dunamic_notification = DynamicMessage::get();
        $success_deal = $dunamic_notification[0]->success_deal_create_message;

//        For Partial Cart
        $carts = Cart::with('user', 'category', 'state')->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->get();
        $additionalCharges = AdditionalPricing::first();

        return view('vendor.deals.listing', compact('deals', 'cities','cartData','additionalCharges','discounts','userPlanID','success_deal','carts'));
    }

    public function cart()
    {
        $deals = Cart::with('user', 'category', 'state')->where('user_id', Auth::user()->id)->get();
        // dd($deals->toArray());
        return view('vendor.deals.cart', compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $states = State::get();

        $checkout= AdditionalPricing::first();
        return view('vendor.deals.create', compact('categories', 'states', 'checkout'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->validationRules);
        if ($validation->fails()) {
            dd($validation->errors());
            return redirect()->back()->withErrors($validation->errors());
        }
        try {
            $image = null;
            if ($request->hasFile('image')) {
                $file = $request->image;
                $fileName = (preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(' ', '_', $file->getClientOriginalName())));
                $ext = $file->getClientOriginalExtension();
                $completeFileName = time() . "!" . $fileName;
                $path = 'uploads/deals/';
                $file->move(public_path($path), $completeFileName);
                $image = $path . $completeFileName;
            }

            $deal = Deals::create([
                'title'    => $request->title,
                'slug'    => $this->generateSlug($request->title),
                'description'     => $request->description,
                'teaser_text'     => $request->teaser_text,
                'image'     => $image,
                'expiration_date' => $request->expire_date,
                'state_id'     => $request->state_id,
                'category_id'     => $request->category_id,
                'price'     => number_format($request->price, '2', '.', ''),
                'offer_price'     => isset($request->offer_price) ? number_format($request->offer_price, '2', '.', '') : NULL,
                'status'     => '0',
                'multiple_cities' => isset($request->multiple_cities) ? json_encode($request->multiple_cities) : NULL,
                'is_featured'     => isset($request->is_featured) ? $request->is_featured : 0,
                'user_id'     => Auth::user()->id,
                'discountcode' => $request->discountcode,
                'payment_done' => '0',
            ]);
            return redirect()->route('vendor.deals.index')->with('success', 'Deal has been saved successfully.');
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::get();

        $states = State::get();

        $checkout= AdditionalPricing::first();

        $deal = Deals::with('user', 'category', 'state')->where('id', $id)->first();

        return view('vendor.deals.edit', compact('categories', 'states', 'deal','checkout'));
    }


    public function editDealCity($id)
    {
        $categories = Category::get();

        $states = State::get();

        $checkout= AdditionalPricing::first();

        $deal = Deals::with('user', 'category', 'state')->where('id', $id)->first();

        return view('vendor.deals.partials.edit-deal-cities', compact('categories', 'states', 'deal','checkout'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id)
    {

        $deal = Deals::find($id);
        $orig_deal= $request->all();


        if (isset($orig_deal['multiple_cities'])){
            $cities = $orig_deal['multiple_cities'];
            if (($key = array_search($orig_deal['multiple_cities'], $orig_deal))) {
                unset($orig_deal[$key]);
            }
            $orig_deal['cities'] = $cities;
        }

        $orig_deal['deal_id'] = $deal->id;

        try {
            $image = $deal->image;
            if ($request->hasFile('image')) {
                $file = $request->image;
                $fileName = (preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(' ', '_', $file->getClientOriginalName())));
                $ext = $file->getClientOriginalExtension();
                $completeFileName = time() . "!" . $fileName;
                $path = 'uploads/deals/';
                $file->move(public_path($path), $completeFileName);
                $image = $path . $completeFileName;
            }
            $orig_deal['deal_image'] = $image;
            $orig_deal['checkout_price'] = $request->checkout_price;
            $deal->title   = $request->title;
            // $deal->slug    = $this->generateSlug($request->title);
            $deal->description    = $request->description;
            $deal->teaser_text    = $request->teaser_text;
            $deal->image    = $image;
            $deal->state_id   = $request->state_id;
            $deal->category_id    = $request->category_id;
            $deal->price    = number_format($request->price, '2', '.', '');
            $deal->offer_price    = isset($request->offer_price) ? number_format($request->offer_price, '2', '.', '') : null;
            $deal->status    = '0';
            $deal->expiration_date = $request->expire_date;
            $deal->is_featured    = '0';
            $existing_cities = 0;
            $deal_multi_cities = json_decode($deal->multiple_cities);
            if (!is_null($deal_multi_cities) && is_array($deal_multi_cities)){
                $existing_cities = count($deal_multi_cities);
            }
            $deal->multiple_cities = json_encode($request->multiple_cities);
            $deal->user_id    = Auth::user()->id;
            $incoming_cities = 0;
            if (isset($orig_deal['cities']) && !is_null($orig_deal['cities'])){
                $incoming_cities = count($orig_deal['cities']);
                $orig_deal['cities'] = json_encode($orig_deal['cities']);
            }
//            dd($orig_deal['cities']);
            if($incoming_cities > $existing_cities && $incoming_cities != 0)
            {
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

                // Creates the Stripe session
                $session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $deal->title,
                                'images' => [$deal->image],
                            ],
                            'unit_amount' => $request->checkout_price*100,
                        ],
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'metadata' => $orig_deal,
                    'customer_email' => \Illuminate\Support\Facades\Auth::user()->email,
                    'success_url' => url('/update_deal_payment_done?session_id={CHECKOUT_SESSION_ID}'),
                    'cancel_url' => url('/advertiser/deals'),
                ]);

                return redirect($session->url);

            }

            else{
                $deal->save();
            }


            NotificationController::deal_update($deal);
            return redirect()->route('vendor.deals.index')->with('success', 'Deal has been updated successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

//    public function update(Request $request, $id)
//    {
//
//        $deal = Deals::find($id);
////        dd($deal);
//        $orig_deal= $request->all();
//        if (isset($orig_deal['multiple_cities'])){
//            $cities = $orig_deal['multiple_cities'];
//            if (($key = array_search($orig_deal['multiple_cities'], $orig_deal))) {
//                unset($orig_deal[$key]);
//            }
//            $orig_deal['cities'] = $cities;
//        }
//
////        dd($orig_deal['cities']);
//
//
//        $orig_deal['deal_id'] = $deal->id;
//
//        try {
//            $image = $deal->image;
//            if ($request->hasFile('image')) {
//                $file = $request->image;
//                $fileName = (preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(' ', '_', $file->getClientOriginalName())));
//                $ext = $file->getClientOriginalExtension();
//                $completeFileName = time() . "!" . $fileName;
//                $path = 'uploads/deals/';
//                $file->move(public_path($path), $completeFileName);
//                $image = $path . $completeFileName;
//            }
//            $orig_deal['deal_image'] = $image;
//            $orig_deal['checkout_price'] = $request->checkout_price;
//            $deal->title   = $request->title;
//            // $deal->slug    = $this->generateSlug($request->title);
//            $deal->description    = $request->description;
//            $deal->teaser_text    = $request->teaser_text;
//            $deal->image    = $image;
//            $deal->state_id   = $request->state_id;
//            $deal->category_id    = $request->category_id;
//            $deal->price    = number_format($request->price, '2', '.', '');
//            $deal->offer_price    = isset($request->offer_price) ? number_format($request->offer_price, '2', '.', '') : null;
//            $deal->status    = '0';
//            $deal->expiration_date = $request->expire_date;
//            $deal->is_featured    = '0';
//            $existing_cities = 0;
//            if (!is_null($deal->multiple_cities) && is_array($deal->multiple_cities)){
//                dd($deal->multiple_cities);
//                $existing_cities = count(json_decode($deal->multiple_cities));
//            }
//            $deal->multiple_cities = json_encode($request->multiple_cities);
//            $deal->user_id    = Auth::user()->id;
//            $incoming_cities = 0;
//            if (isset($orig_deal['cities']) && !is_null($orig_deal['cities'])){
//                $incoming_cities = count($orig_deal['cities']);
//                $orig_deal['cities'] = json_encode($orig_deal['cities']);
//            }
////            dd($orig_deal['cities']);
//
//            if($incoming_cities > $existing_cities)
//            {
//                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
//
//                // Creates the Stripe session
//                $session = \Stripe\Checkout\Session::create([
//                    'payment_method_types' => ['card'],
//                    'line_items' => [[
//                        'price_data' => [
//                            'currency' => 'usd',
//                            'product_data' => [
//                                'name' => $deal->title,
//                                'images' => [$deal->image],
//                            ],
//                            'unit_amount' => $request->checkout_price*100,
//                        ],
//                        'quantity' => 1,
//                    ]],
//                    'mode' => 'payment',
//                    'metadata' => $orig_deal,
//                    'customer_email' => \Illuminate\Support\Facades\Auth::user()->email,
//                    'success_url' => url('/update_deal_payment_done?session_id={CHECKOUT_SESSION_ID}'),
//                    'cancel_url' => url('/advertiser/deals'),
//                ]);
//                return redirect($session->url);
//
//            }
//
//            else{
//                $deal->save();
//            }
//
//
//            NotificationController::deal_update($deal);
//            return redirect()->route('vendor.deals.index')->with('success', 'Deal has been updated successfully.');
//        } catch (\Throwable $e) {
//            return redirect()->back()->with("error", $e->getMessage());
//        }
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Deals::where('id', $id)->delete();
        UserDeal::where('deal_id', $id)->delete();
        UserDealReview::where('deal_id', $id)->delete();
        return redirect()->route('vendor.deals.index')->with('success', 'Deal has been deleted successfully.');
    }

    public function generateSlug($title)
    {
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));
        $count = Deals::where('slug', 'LIKE',  '%' . $slug . '%')->get()->count();

        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }

    public function dealView()
    {

//        $dealViews = DealViewed::where('user_id', Auth::user()->id)->with('deals')->get();
//        dd($dealViews);
//        dd(Auth::user()->id);


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

        return view('vendor.deal_view.deal_view', compact('dealViews'));

    }

    public function dealViewByUser()
    {

        $advertiserDeals = Deals::where('user_id', Auth::user()->id)->get();

        $dealViewByUsers = [];

        foreach ($advertiserDeals as $adDeals){

            $SaveDeals = UserDeal::where('deal_id', $adDeals->id)->get();

            foreach ($SaveDeals as $sd){

                if ($sd->deal_id == $adDeals->id){

                    $dealViewByUsers[] = $sd;

                }
            }

        }

//        dd($dealViewByUsers);

        return view('vendor.deal_view.deals-view-by-users', compact('dealViewByUsers'));
    }

}
