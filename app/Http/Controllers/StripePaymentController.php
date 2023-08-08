<?php

namespace App\Http\Controllers;
// Add the response in so we can return the session as JSON

use App\Mail\InvoiceMail;
use App\Models\AdditionalPricing;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\Deals;
use App\Models\Discount;
use App\Models\DynamicMessage;
use App\Models\User;
use App\Models\Payments;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// To use Stripe PHP API
use Illuminate\Support\Facades\Mail;
use Session;
use Stripe;

class StripePaymentController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    /* Creates the checkout session and returns the session id in JSON format */
    public function payment()
    {
        // We grab the Stripe key information we added in the .env file
//        dd(env('STRIPE_SECRET'));

//        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        // Creates the Stripe session
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://deals.com/deals',
            'cancel_url' => 'http://deals.com/deals',
        ]);

        // Return the Stripe Session id so the fetch command in our frontend redirects users to Stripe's checkout page
        //return response()->json(['id' => $session]);
        //return redirect($session->url);
        return view('front.checkout', compact('session'));
    }

    public function deal_payment(Request $request)
    {

        $discountCode = Discount::where('name', $request->input('discount', null))->first();


        if (!isset(Auth::user()->plan_id) || Auth::user()->plan_expiry_date < Carbon::now()) {

            $discounts = Billing::where('status', '1')->get();

            $deal = Cart::where('id', $request->deal_id)->first();

            return view('vendor.pricing2', compact('deal', 'discounts','discountCode'));

        }

        elseif($request->input('checkout_price', 0.00) == 0.00 ){

            $cart = Cart::where('id', $request->deal_id)->get();

            $deal = Deals::create([
                'title' => $cart[0]->title,
                'slug' => $this->generateSlug($cart[0]->slug),
                'description' => $cart[0]->description,
                'teaser_text' => $cart[0]->teaser_text,
                'image' => $cart[0]->image,
                'expiration_date' => $cart[0]->expiration_date,
                'state_id' => $cart[0]->state_id,
                'category_id' => $cart[0]->category_id,
                'price' => number_format($cart[0]->price - ($discountCode ? $discountCode->value : 0), '2', '.', ''),
                'offer_price' => isset($cart[0]->offer_price) ? number_format($cart[0]->offer_price, '2', '.', '') : null,
                'status' => '0',
                'multiple_cities' => isset($cart[0]->multiple_cities) ? $cart[0]->multiple_cities : null,
                'is_featured' => isset($cart[0]->is_featured) ? $cart[0]->is_featured : 0,
                'user_id' => $cart[0]->user_id,
                'discountcode' => $cart[0]->discountcode,
                'payment_done' => '1',
            ]);

            $updateUser = array(
                'free_deal' => 'used',
            );

            User::where('id', $cart[0]->user_id)->update($updateUser);


            NotificationController::new_free_deal_to_approve($cart[0]);

            NotificationController::advertiser_deal_notify($cart[0]);

            $cart[0]->delete();

            $dunamic_notification = DynamicMessage::get();

            $success_deal = $dunamic_notification[0]->success_deal_create_message;

            return redirect()->route('vendor.deals.index')

                ->with('success_payment', isset($success_deal) ? $success_deal : 'Your checkout data send to admin, please wait for their moderation before publish your Deal!');

        }

        else{


//            dd("else");
            // We grab the Stripe key information we added in the .env file
//        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            // Creates the Stripe session
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $request->deal_title,
                            'images' => [$request->deal_image],
                        ],
                        'unit_amount' => $request->checkout_price * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'metadata' => [$request->deal_id],
                'customer_email' => Auth::user()->email,
                'success_url' => url('/deal-payment-done?session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => url('/advertiser/deals'),
            ]);

            // Return the Stripe Session id so the fetch command in our frontend redirects users to Stripe's checkout page
            //return response()->json($session);
            //Cart::where('id', $request->deal_id)->update(['payment_id', $session->id]);
            return redirect($session->url);
            //return view('front.checkout', compact('session'));
        }
    }

    public function deal_payment_free(Request $request)
    {

        $cart = Cart::where('id', $request->deal_id)->get();

        $deal = Deals::create([
            'title' => $cart[0]->title,
            'slug' => $this->generateSlug($cart[0]->slug),
            'description' => $cart[0]->description,
            'teaser_text' => $cart[0]->teaser_text,
            'image' => $cart[0]->image,
            'expiration_date' => $cart[0]->expiration_date,
            'state_id' => $cart[0]->state_id,
            'category_id' => $cart[0]->category_id,
            'price' => number_format($cart[0]->price, '2', '.', ''),
            'offer_price' => isset($cart[0]->offer_price) ? number_format($cart[0]->offer_price, '2', '.', '') : null,
            'status' => '0',
            'multiple_cities' => isset($cart[0]->multiple_cities) ? $cart[0]->multiple_cities : null,
            'is_featured' => isset($cart[0]->is_featured) ? $cart[0]->is_featured : 0,
            'user_id' => $cart[0]->user_id,
            'discountcode' => $cart[0]->discountcode,
            'payment_done' => '1',
        ]);

        $updateUser = array(
            'free_deal' => 'used',
        );

        User::where('id', $cart[0]->user_id)->update($updateUser);
        NotificationController::new_free_deal_to_approve($cart[0]);
        NotificationController::advertiser_deal_notify($cart[0]);
        $cart[0]->delete();

        $dunamic_notification = DynamicMessage::get();
        $success_deal = $dunamic_notification[0]->success_deal_create_message;
        return redirect()->route('vendor.deals.index')
            ->with('success_payment', isset($success_deal) ? $success_deal : 'Your checkout data send to admin, please wait for their moderation before publish your Deal!');
    }

    public function deal_payment_done(Request $request)
    {
//        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));


        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        $session1 = \Stripe\Checkout\Session::allLineItems($request->get('session_id'));
        $customer = \Stripe\Customer::retrieve($session->customer);
//        dd($session->metadata[0]);

        $cart = Cart::where('id', $session->metadata[0])->get();
        //return $session1->data[0]->description;
        //return $cart[0];
        //return $session->payment_status;

        if ($session->payment_status == 'paid') {

            $deal = Deals::create([
                'title' => $cart[0]->title,
                'slug' => $this->generateSlug($cart[0]->slug),
                'description' => $cart[0]->description,
                'teaser_text' => $cart[0]->teaser_text,
                'image' => $cart[0]->image,
                'expiration_date' => $cart[0]->expiration_date,
                'state_id' => $cart[0]->state_id,
                'category_id' => $cart[0]->category_id,
                'price' => number_format($cart[0]->price, '2', '.', ''),
                'offer_price' => isset($cart[0]->offer_price) ? number_format($cart[0]->offer_price, '2', '.', '') : null,
                'status' => '0',
                'multiple_cities' => isset($cart[0]->multiple_cities) ? $cart[0]->multiple_cities : null,
                'is_featured' => isset($cart[0]->is_featured) ? $cart[0]->is_featured : 0,
                'user_id' => $cart[0]->user_id,
                'discountcode' => $cart[0]->discountcode,
                'payment_done' => '1',
            ]);

            $updateUser = array(
                'free_deal' => 'used',
            );

            $payments = Payments::create([
                'user_id' => Auth::user()->id,
                'details' => $cart[0]->title,
                'value' => $cart[0]->checkout_price,
            ]);

//            dd($payments);

            User::where('id', $cart[0]->user_id)->update($updateUser);

//            dd($cart);

            $pdf = PDF::loadView('mails.invoice-email', compact('deal','payments'));

//            return $pdf->download('report.pdf');


            NotificationController::new_deal_to_approve($cart[0], $session, $pdf);

            NotificationController::advertiser_deal_notify($cart[0], $pdf);


//            dd("ok");


            $cart[0]->delete();
            $dunamic_notification = DynamicMessage::get();
            $success_deal = $dunamic_notification[0]->success_deal_create_message;

            return redirect()->route('vendor.deals.index')->with('success_payment', isset($success_deal) ? $success_deal :'Your checkout data send to admin, please wait for their moderation before publish your Deal!');
        } else {
            return redirect()->route('vendor.cart')->with("error", "Something went wrong, Please try again!");
        }
    }
    public function update_deal_payment_done(Request $request)
    {
//        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        $session1 = \Stripe\Checkout\Session::allLineItems($request->get('session_id'));
        $customer = \Stripe\Customer::retrieve($session->customer);
        $updated_deal = $session->metadata;
        $deal = Deals::where('id', $session->metadata['deal_id'])->get();

        $origional_deal = $deal[0];


        if ($session->payment_status == 'paid') {

            $title_payment = $origional_deal->title;
            $origional_deal->title   = $updated_deal->title;
            // $deal->slug    = $this->generateSlug($request->title);
            $origional_deal->description    = $updated_deal->description;
            $origional_deal->teaser_text    = $updated_deal->teaser_text;
            $origional_deal->image = $updated_deal->deal_image;
            $origional_deal->state_id = $updated_deal->state_id;
            $origional_deal->category_id    = $updated_deal->category_id;
            $origional_deal->price    = number_format($updated_deal->price, '2', '.', '');
            $origional_deal->offer_price    = isset($updated_deal->offer_price) ? number_format($updated_deal->offer_price, '2', '.', '') : null;
            $origional_deal->status    = '0';
            $origional_deal->expiration_date = $updated_deal->expire_date;
            $origional_deal->is_featured    = '0';
            $origional_deal->multiple_cities = $updated_deal->cities;
            $origional_deal->user_id    = Auth::user()->id;
            $origional_deal->save();

            $origional_payment = Payments::where('details', $title_payment)->where('user_id', Auth::user()->id)->get();
            if (isset($origional_payment[0])) {
                $origional_deal_payment = $origional_payment[0];
                $origional_deal_payment->user_id = $origional_deal->user_id;
                $origional_deal_payment->details = $origional_deal->title;
                $origional_deal_payment->value = $updated_deal->checkout_price;
                $origional_deal_payment->save();
            }
//            $payments = Payments::create([
//                'user_id' => Auth::user()->id,
//                'details' => $cart[0]->title,
//                'value' => $cart[0]->checkout_price,
//
//            ]);

            NotificationController::deal_update($origional_deal);
            return redirect()->route('vendor.deals.index')->with('success', 'Deal has been updated successfully.');
        } else {
            return redirect()->route('vendor.deals.index')->with("error", "Something went wrong, Please try again!");
        }
    }

    public function plan_payment(Request $request)
    {
        // We grab the Stripe key information we added in the .env file
//        \Stripe\Stripe::setApiKey('sk_test_51JL96NFLX1A0SynvQEsYl53floSgILrG9taSZdlreguk8QeGU2KtsB2VQx7DFB5gH3DKvd9S8RQ5RBYywPHyJeWO00zLL4j0HM');

//        dd($request->all());

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));



        // Creates the Stripe session
        $session = \Stripe\Checkout\Session::create(
            [
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $request->details,
                    ],
                    'unit_amount' => $request->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'metadata' => [$request->cart_id, $request->plan_id, $request->plan_expiry, $request->details2, $request->price],
            'customer_email' => Auth::user()->email,
            'success_url' => url('/plan-payment-done?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => url('/advertiser/pricing'),
        ]);


        // Return the Stripe Session id so the fetch command in our frontend redirects users to Stripe's checkout page
        //return response()->json($session);
        //Cart::where('id', $request->deal_id)->update(['payment_id', $session->id]);
        return redirect($session->url);
        //return view('front.checkout', compact('session'));
    }

    public function plan_payment_all(Request $request)
    {
        // We grab the Stripe key information we added in the .env file
//        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        // Creates the Stripe session
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $request->details,
                    ],
                    'unit_amount' => $request->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'metadata' => [$request->plan_id, $request->plan_expiry, $request->details2, $request->plan_price],
            'customer_email' => Auth::user()->email,
            'success_url' => url('/plan-payment-all-done?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => 'http://dealsforweddings.com/advertiser/cart',
        ]);

        // Return the Stripe Session id so the fetch command in our frontend redirects users to Stripe's checkout page
        //return response()->json($session);
        //Cart::where('id', $request->deal_id)->update(['payment_id', $session->id]);
        return redirect($session->url);
        //return view('front.checkout', compact('session'));
    }

    public function plan_payment_done(Request $request)
    {



//        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        $session1 = \Stripe\Checkout\Session::allLineItems($request->get('session_id'));
        $customer = \Stripe\Customer::retrieve($session->customer);




        $cart = Cart::where('id', $session->metadata[0])->get();



//        dd($session->metadata[0]);

        $plan = $session->metadata[1];
        $plan_exp = $session->metadata[2];


        //return $session1->data[0]->description;
        //return $session;
        //return $cart[0];
        //return $session->payment_status;
        if ($session->payment_status == 'paid') {

            $deal = Payments::create([
                'user_id' => Auth::user()->id,
                'details' => $session->metadata[3],
                'value' => $session->metadata[4],

            ]);

            $user = User::find(Auth::user()->id);
            $user->plan_id = $plan;
            $user->plan_expiry_date = Carbon::now()->addDay($plan_exp);
            $user->save();

            NotificationController::plan_payment($session);

            $usr = User::where('id', Auth::user()->id)->first();

            if ($session->metadata[0] == ""){
                $dunamic_notification = DynamicMessage::get();
                $success_deal = $dunamic_notification[0]->success_deal_create_message;

                return redirect()->route('vendor.dashboard')->with('success_payment', isset($success_deal) ? $success_deal :'Your checkout data send to admin, please wait for their moderation before publish your Deal!');

            }else{
                    $deal = Deals::create([
                        'title' => $cart[0]->title,
                        'slug' => $this->generateSlug($cart[0]->slug),
                        'description' => $cart[0]->description,
                        'teaser_text' => $cart[0]->teaser_text,
                        'image' => $cart[0]->image,
                        'expiration_date' => $cart[0]->expiration_date,
                        'state_id' => $cart[0]->state_id,
                        'category_id' => $cart[0]->category_id,
                        'price' => number_format($cart[0]->price, '2', '.', ''),
                        'offer_price' => isset($cart[0]->offer_price) ? number_format($cart[0]->offer_price, '2', '.', '') : null,
                        'status' => '0',
                        'multiple_cities' => isset($cart[0]->multiple_cities) ? $cart[0]->multiple_cities : null,
                        'is_featured' => isset($cart[0]->is_featured) ? $cart[0]->is_featured : 0,
                        'user_id' => Auth::user()->id,
                        'discountcode' => $cart[0]->discountcode,
                        'payment_done' => '1',
                    ]);

                    $updateUser = array(
                        'free_deal' => 'used',
                    );

                    User::where('id', Auth::user()->id)->update($updateUser);

                    NotificationController::new_deal_to_approve($cart[0], $session ,$pdf =null);

                    $cart[0]->delete();
                    $dunamic_notification = DynamicMessage::get();
                    $success_deal = $dunamic_notification[0]->success_deal_create_message;

                    return redirect()->route('vendor.deals.index')->with('success_payment', isset($success_deal) ? $success_deal : 'Your checkout data send to admin, please wait for their moderation before publish your Deal!');

            }

        } else {
            return redirect()->route('vendor.cart')->with("error", "Something went wrong, Please try again!");
        }
    }

    public function checkout_all(Request $request)
    {

        $totalCheckoutAllPrice = (int)$request->total_checkout_price;

//        dd($totalCheckoutAllPrice);

        if (!isset(Auth::user()->plan_id) || Auth::user()->plan_expiry_date < Carbon::now()) {

            $discounts = Billing::where('status', '1')->get();
            $deal = Cart::where('user_id', Auth::user()->id)->get();
            $deal_price = AdditionalPricing::where('id', '1')->first();
            $count_deal = count($deal);


            if ($count_deal > 1) {
                $paid_deal = $count_deal - 1;
            } else {
                $paid_deal = 0;
            }
            $checkout_price = 0;
            foreach ($deal as $key => $value) {
                $checkout_price += $value->checkout_price;
            }
            return view('vendor.pricing3', compact('deal', 'discounts', 'paid_deal', 'deal_price', 'checkout_price'));

        } elseif($totalCheckoutAllPrice == 0){

            $cart = Cart::where('user_id', Auth::user()->id)->get();

            foreach ($cart as $value) {
                $deal = Deals::create([
                    'title' => $value->title,
                    'slug' => $this->generateSlug($value->slug),
                    'description' => $value->description,
                    'teaser_text' => $value->teaser_text,
                    'image' => $value->image,
                    'expiration_date' => $value->expiration_date,
                    'state_id' => $value->state_id,
                    'category_id' => $value->category_id,
                    'price' => number_format($value->price, '2', '.', ''),
                    'offer_price' => isset($value->offer_price) ? number_format($value->offer_price, '2', '.', '') : null,
                    'status' => '0',
                    'multiple_cities' => isset($value->multiple_cities) ? $value->multiple_cities : null,
                    'is_featured' => isset($value->is_featured) ? $value->is_featured : 0,
                    'user_id' => $value->user_id,
                    'discountcode' => $value->discountcode,
                    'payment_done' => '1',
                ]);

                $updateUser = array(
                    'free_deal' => 'used',
                );

                $payments = Payments::create([
                    'user_id' => Auth::user()->id,
                    'details' => $value->title,
                    'value' => $value->checkout_price,

                ]);
                User::where('id', $value->user_id)->update($updateUser);

//                NotificationController::new_deal_to_approve($value, $session=null, $pdf=null);

                NotificationController::new_free_deal_to_approve($cart[0]);
                NotificationController::advertiser_deal_notify($value);
                $value->delete();
            }
            $dunamic_notification = DynamicMessage::get();
            $success_deal = $dunamic_notification[0]->success_deal_create_message;
            return redirect()->route('vendor.deals.index')->with('success_payment', isset($success_deal) ? $success_deal :'Your checkout data send to admin, please wait for their moderation before publish your Deal!');

        } else{

            // We grab the Stripe key information we added in the .env file
//        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $cart = Cart::where('user_id', Auth::user()->id)->get();

            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Checkout all',

                        ],
                        'unit_amount' => $totalCheckoutAllPrice * 100,
//                        'unit_amount' => 100 * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'metadata' => [$request->total_checkout_price],
                'customer_email' => Auth::user()->email,
                'success_url' => url('/checkout-all-done?session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => url('/advertiser/cart'),
            ]);


            // Return the Stripe Session id so the fetch command in our frontend redirects users to Stripe's checkout page
            //return response()->json($session);
            //Cart::where('id', $request->deal_id)->update(['payment_id', $session->id]);
            return redirect($session->url);
            //return $session;
            //return view('front.checkout', compact('session'));
        }
    }

    public function checkout_all_done(Request $request)
    {
//        dd("checkout_all_done");

//        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        $session1 = \Stripe\Checkout\Session::allLineItems($request->get('session_id'));
        $customer = \Stripe\Customer::retrieve($session->customer);
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        //return $session1->data[0]->description;
        //return $cart[0];
        //return $session->payment_status;
        //return $cart;
        if ($session->payment_status == 'paid') {
            foreach ($cart as $value) {
                $deal = Deals::create([
                    'title' => $value->title,
                    'slug' => $this->generateSlug($value->slug),
                    'description' => $value->description,
                    'teaser_text' => $value->teaser_text,
                    'image' => $value->image,
                    'expiration_date' => $value->expiration_date,
                    'state_id' => $value->state_id,
                    'category_id' => $value->category_id,
                    'price' => number_format($value->price, '2', '.', ''),
                    'offer_price' => isset($value->offer_price) ? number_format($value->offer_price, '2', '.', '') : null,
                    'status' => '0',
                    'multiple_cities' => isset($value->multiple_cities) ? $value->multiple_cities : null,
                    'is_featured' => isset($value->is_featured) ? $value->is_featured : 0,
                    'user_id' => $value->user_id,
                    'discountcode' => $value->discountcode,
                    'payment_done' => '1',
                ]);

                $updateUser = array(
                    'free_deal' => 'used',
                );

                $payments = Payments::create([
                    'user_id' => Auth::user()->id,
                    'details' => $value->title,
                    'value' => $value->checkout_price,

                ]);
                User::where('id', $value->user_id)->update($updateUser);
                NotificationController::new_deal_to_approve($value, $session, $pdf=null);
                NotificationController::advertiser_deal_notify($value);
                $value->delete();
            }
            $dunamic_notification = DynamicMessage::get();
            $success_deal = $dunamic_notification[0]->success_deal_create_message;
            return redirect()->route('vendor.deals.index')->with('success_payment', isset($success_deal) ? $success_deal : 'Your checkout data send to admin, please wait for their moderation before publish your Deal!');
        } else {
            return redirect()->route('vendor.cart')->with("error", "Something went wrong, Please try again!");
        }
    }

    public function plan_payment_all_done(Request $request)
    {
//        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        $session1 = \Stripe\Checkout\Session::allLineItems($request->get('session_id'));
        $customer = \Stripe\Customer::retrieve($session->customer);
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $plan = $session->metadata[0];
        $plan_exp = $session->metadata[1];
        //return $session1->data[0]->description;
        //return $cart[0];
        //return $session->payment_status;
        //return $cart;
        if ($session->payment_status == 'paid') {
            $payment = Payments::create([
                'user_id' => Auth::user()->id,
                'details' => $session->metadata[2],
                'value' => $session->metadata[3],

            ]);
            $user = User::find(Auth::user()->id);
            $user->plan_id = $session->metadata[0];
            $user->plan_expiry_date = Carbon::now()->addDay($plan_exp);
            $user->save();
            NotificationController::plan_payment($session);
            foreach ($cart as $value) {
                $deal = Deals::create([
                    'title' => $value->title,
                    'slug' => $this->generateSlug($value->slug),
                    'description' => $value->description,
                    'teaser_text' => $value->teaser_text,
                    'image' => $value->image,
                    'expiration_date' => $value->expiration_date,
                    'state_id' => $value->state_id,
                    'category_id' => $value->category_id,
                    'price' => number_format($value->price, '2', '.', ''),
                    'offer_price' => isset($value->offer_price) ? number_format($value->offer_price, '2', '.', '') : null,
                    'status' => '0',
                    'multiple_cities' => isset($value->multiple_cities) ? $value->multiple_cities : null,
                    'is_featured' => isset($value->is_featured) ? $value->is_featured : 0,
                    'user_id' => $value->user_id,
                    'discountcode' => $value->discountcode,
                    'payment_done' => '1',
                ]);
                $updateUser = array(
                    'free_deal' => 'used',
                );

                $payments = Payments::create([
                    'user_id' => Auth::user()->id,
                    'details' => $value->title,
                    'value' => $value->checkout_price,

                ]);
                User::where('id', $value->user_id)->update($updateUser);
                NotificationController::new_deal_to_approve($value, $session);
                NotificationController::advertiser_deal_notify($value);
                $value->delete();
            }
            return redirect()->route('vendor.deals.index')->with('success_payment', 'Your checkout data send to admin, please wait for their moderation before publish your Deal!');

        } else {
            return redirect()->route('vendor.cart')->with("error", "Something went wrong, Please try again!");
        }
    }

    public function generateSlug($title)
    {
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));
        $count = Deals::where('slug', 'LIKE', '%' . $slug . '%')->get()->count();
        //$count = Cart::where('slug', 'LIKE',  '%' . $slug . '%')->get()->count();

        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }
}
