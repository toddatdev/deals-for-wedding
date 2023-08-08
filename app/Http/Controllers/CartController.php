<?php

namespace App\Http\Controllers;

use App\Models\AdditionalPricing;
use App\Models\Cart;
use App\Models\Category;
use App\Models\DynamicMessage;
use App\Models\Payments;
use App\Models\Billing;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    protected $validationRules = [
        'title' => 'required|string',
        'category_id' => 'required|numeric',
        'state_id' => 'required|numeric',
        'description' => 'required',
        'price' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $discounts = Billing::where('status', '1')
            ->get();

        $userPlanID = Billing::where('id', auth()->user()->plan_id)->first();

        $carts = Cart::with('user', 'category', 'state')->where('user_id', Auth::user()->id)->get();

        $cities = State::get();
        $additionalCharges = AdditionalPricing::first();


        // dd($deals->toArray());
        return view('vendor.deals.cart', compact('carts', 'cities','additionalCharges','discounts','userPlanID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
//            dd($validation->errors());
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
            }else{
                $image = 'uploads/deals/dummy-product-image.jpg';
            }

                $deal = Cart::create([
                    'title'    => $request->title,
                    'slug'    => $this->generateSlug($request->title),
                    'description'     => $request->description,
                    'teaser_text'     => $request->teaser_text,
                    'image'     => $image,
                    'expiration_date' => $request->expire_date,
                    'state_id'     => $request->state_id,
                    'category_id'     => $request->category_id,
                    'price'     => number_format($request->price, '2', '.', ''),
                    'offer_price'     => isset($request->offer_price) ? number_format($request->offer_price, '2', '.', '') : null,
                    'multiple_cities' => isset($request->multiple_cities) ? json_encode($request->multiple_cities) : null,
                    'user_id'     => Auth::user()->id,
                    'is_free'     => null,
                    'discountcode' => $request->discountcode,
                    'checkout_price' => $request->checkout_price,

                ]);

//            if (Auth::user()->free_deal == null){
//
//                User::findOrFail(Auth::user()->id)->update([
//                    'free_deal' => 'used'
//                ]);
//
//            }

            $discounts = Billing::where('status', '1')->get();

//            if($request->has('checkout')){
//                if (isset(Auth::user()->plan_id) && Auth::user()->plan_expiry_date > Carbon::now()) {
//                    return view('vendor.deals.checkoutprocess', compact('deal'));
//                } else {
//                    return view('vendor.pricing2', compact('deal', 'discounts'));
//                }
//            }else {
//
//            return redirect()->route('vendor.cart')->with('success', 'Deal has been added to cart successfully.');
//
//            }

            if ($request->has('goToAddToCart')){

                return redirect()->route('vendor.cart')->with('success', 'Deal has been added to cart successfully.');

            } elseif ($request->has('createNewDeal')){

                return redirect()->route('vendor.deals.create')->with('success', 'Your Deal has been added in cart now you can create another deal!');

            }else{

                return redirect()->back();

            }

        } catch (\Throwable $e) {
//            dd($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }


    public function checkout(Request $request)
    {
        $validation = Validator::make($request->all(), $this->validationRules);
        if ($validation->fails()) {
//            dd($validation->errors());
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

            $deal = Cart::create([
                'title'    => $request->title,
                'slug'    => $this->generateSlug($request->title),
                'description'     => $request->description,
                'teaser_text'     => $request->teaser_text,
                'image'     => $image,
                'expiration_date' => $request->expire_date,
                'state_id'     => $request->state_id,
                'category_id'     => $request->category_id,
                'price'     => number_format($request->price, '2', '.', ''),
                'offer_price'     => isset($request->offer_price) ? number_format($request->offer_price, '2', '.', '') : null,
                'multiple_cities' => isset($request->multiple_cities) ? json_encode($request->multiple_cities) : null,
                'user_id'     => Auth::user()->id,
                'discountcode' => $request->discountcode,
                'checkout_price' => $request->checkout_price,
            ]);
            $payments = Payments::create([
                'user_id'    => Auth::user()->id,
                'details'     => $request->title,
                'value'     => $request->checkout_price,

            ]);
            return view('vendor.checkoutprocess', compact('deal'))->with('success', 'Deal has been added to cart successfully.');
        } catch (\Throwable $e) {
//            dd($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }

    }

    public function plancheckout(Request $request) 
    {
        try {

//            dd($request->all());

            // $deal = Payments::create([
            //     'user_id'    => $request->user_id,
            //     'details'     => $request->details,
            //     'value'     => $request->price,

            // ]);
            $data = $request;

            $user = User::find($request->user_id);
            // $user->plan_id = $request->plan_id;
            // $user->plan_expiry_date = Carbon::now()->addDay($request->plan_expiry);
            // $user->save();
            $dunamic_notification = DynamicMessage::get();
            $success_plan_purchase = $dunamic_notification[0]->success_subscription_message;

            if(isset($request->cart_id)) {


                $additionalPricing = \App\Models\AdditionalPricing::first();
                $adListPrice = $additionalPricing->per_listing_price;
                $vendorDeals = \App\Models\Deals::where('user_id', Auth::user()->id)->get();

                $cart = $request->cart_id;

                return view('vendor.pricingcheckout', compact('user', 'cart', 'data', 'additionalPricing','adListPrice','vendorDeals'))->with('success', isset($success_plan_purchase) ? $success_plan_purchase :'Plan Purchased successfully.');
            }

            else {


                $additionalPricing = \App\Models\AdditionalPricing::first();

                $adListPrice = 0;

                $vendorDeals = \App\Models\Deals::where('user_id', Auth::user()->id)->get();


                return view('vendor.pricingcheckout', compact('data', 'user','additionalPricing','adListPrice','vendorDeals'))->with('success', isset($success_plan_purchase) ? $success_plan_purchase : 'Plan Purchased successfully.');

            }
        } catch (\Throwable $e) {
//            dd($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }

    }
    public function plancheckoutall(Request $request) 
    {
        try {

            // $deal = Payments::create([
            //     'user_id'    => $request->user_id,
            //     'details'     => $request->details,
            //     'value'     => $request->price,

            // ]);
            $data = $request;
            $user = User::find($request->user_id);
            // $user->plan_id = $request->plan_id;
            // $user->plan_expiry_date = Carbon::now()->addDay($request->plan_expiry);
            // $user->save();
            $dunamic_notification = DynamicMessage::get();
            $success_plan_purchase = $dunamic_notification[0]->success_subscription_message;

            return view('vendor.pricingcheckoutall', compact('data', 'user'))->with('success', isset($success_plan_purchase) ? $success_plan_purchase : 'Plan Purchased successfully.');
            
        } catch (\Throwable $e) {
//            dd($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }

    }

    public function checkoutprocess ()
    {
        return view('vendor.deals.checkoutprocess');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $categories = Category::get();
        $states = State::get();
        $checkout= AdditionalPricing::first();
        $deal = Cart::with('user', 'category', 'state')->where('id', $id)->first();
        return view('vendor.deals.edit_cart', compact('categories', 'states', 'deal','checkout'));
    }

    public function editCity($id)
    {

        $categories = Category::get();
        $states = State::get();
        $checkout= AdditionalPricing::first();
        $deal = Cart::with('user', 'category', 'state')->where('id', $id)->first();

        return view('vendor.deals.partials.edit-cart-cities', compact('categories', 'states', 'deal','checkout'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $deal = Cart::find($id);
//         dd($request->all());
        //dd($deal);

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

            $deal->title   = $request->title;
            // $deal->slug    = $this->generateSlug($request->title);
            $deal->description    = $request->description;
            $deal->teaser_text    = $request->teaser_text;
            $deal->image    = $image;
            $deal->state_id   = $request->state_id;
            $deal->category_id    = $request->category_id;
            $deal->price    = number_format($request->price, '2', '.', '');
            $deal->offer_price    = isset($request->offer_price) ? number_format($request->offer_price, '2', '.', '') : null;
            $deal->expiration_date = $request->expire_date;


            $deal->checkout_price = $request->checkout_price;

            $deal->multiple_cities = json_encode($request->multiple_cities);

//            dd($deal->multiple_cities);

            $deal->user_id    = Auth::user()->id;
            $deal->save();

            return redirect()->route('vendor.cart')->with('success', 'Deal has been updated successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::where('id', $id)->delete();
        return redirect()->route('vendor.cart')->with('success', 'Cart item has been deleted successfully.');
    }

    public function generateSlug($title)
    {
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));
        //$count = Category::where('slug', 'LIKE',  '%' . $slug . '%')->get()->count();
        $count = Cart::where('slug', 'LIKE',  '%' . $slug . '%')->get()->count();

        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }
}
