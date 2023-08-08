<?php

namespace App\Http\Controllers;

use App\Models\EmailCopy;
use App\Models\User;
use App\Models\UserDetails;
use App\Notifications\DealApproved;
use App\Notifications\DealViewed;
use App\Notifications\UpdateDeal;
use App\Notifications\NewDeal;
use App\Notifications\PlanPayment;
use App\Notifications\TestEmail;
use App\Notifications\UserReg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\b;

class NotificationController extends Controller
{
    public function testMail ()
    {
        $user = User::first();
        $TestData = [
            'body' => 'Your Deal Got a new view',
            'text' => 'Click here to view details',
            'url' => url('/deals'),
            'thankyou' => 'You have 3 days to check'
        ];

        $user->notify(new TestEmail($TestData));
    }

    public function deal_notify(Request $request)
    {
        $authorid = $request->advertiser;
        $author = User::where('id', $authorid)->first();
        $author_name = $request->advertiser_name;
        $user = $request->user_name;
        $user_email = $request->user_email;

        $wedding_date = $request->wedding_date;
        $dealname = $request->deal_name;

        $getUserEmail = User::where('email', $user_email)->first();

        $getUserDetails = UserDetails::where('user_id', $getUserEmail->id)->first();

        $user_phone = $getUserDetails->phone;



        $dealviewdata = [
            'subject' => $dealname . ' has got a new view!',
            'greeting' => 'Hello' . ' ' . $author_name,
            'body' => 'Your Deal '.  $dealname . ' Viewed by ' . $user,
            'user_detail' =>  'The Email is '. $user_email. '<br/>'. 'The Phone Number is '. $user_phone. '<br/>'. 'The Wedding Date is'. $wedding_date,
            'url' => url('/advertiser/deals/viewed_deals'),
            'text' => 'View User Details!',
            'notifyto' => $author
        ];

        $author->notify(new DealViewed($dealviewdata));
    }
    public static function advertiser_registration_notify($advertiser)
    {
        $authorid = $advertiser;
        $author = User::where('id', $authorid)->first();
        $author_name = $author->fname;
        $body = EmailCopy::where('id', 1)->first();
        $dealviewdata = [
            'subject' => 'Welcome to Deals for Weddings!',
            'greeting' => 'Hello' . ' ' . $author_name,
            'body' => $body->new_advertiser_reg,
            'url' => url('/advertiser/login'),
            'text' => 'Login to your Account!',
            'notifyto' => $author
        ];

        $author->notify(new UserReg($dealviewdata, null));
    }


    public static function advertiser_deal_notify($cart, $pdf=null)
    {
        $authorid = $cart->user_id;
        $author = User::where('id', $authorid)->first();
        $author_name = $author->fname;
        $body = EmailCopy::where('id', 1)->first();
        $dealviewdata = [
            'subject' => 'Welcome to Deals for Weddings!',
            'greeting' => 'Hello' . ' ' . $author_name,
            'body' => $body->new_deal_submit,
            'url' => url('/advertiser/deals'),
            'text' => 'View your Deal!',
            'notifyto' => $author
        ];

        $author->notify(new UserReg($dealviewdata, $pdf));
    }


    public static function user_registration_notify($advertiser)
    {
        $authorid = $advertiser;
        $author = User::where('id', $authorid)->first();
        $author_name = $author->fname;
        $body = EmailCopy::where('id', 1)->first();
        $dealviewdata = [
            'subject' => 'Welcome to Deals for Weddings!',
            'greeting' => 'Hello' . ' ' . $author_name,
            'body' => $body->new_user_reg,
            'url' => url('/login'),
            'text' => 'Login to your Account!',
            'notifyto' => $author
        ];

        $author->notify(new UserReg($dealviewdata,null));
    }

    public static function new_deal_to_approve($cart, $session, $pdf=null)
    {
        $authors = User::where('role', '1')->get();
        foreach ($authors as $author) {
        $author_name = $author->lname;
        $dealname = $cart->title;

        $dealviewdata = [
            'subject' => $dealname . ' waiting for your approval!',
            'greeting' => 'Hello' . ' ' . $author_name,
            'body' => 'A new Deal Waiting for your approval.',
            'lineName' => 'Deal Name: ' .  $dealname ,
            'lineStatus' => ' Payment Status: ' . $session->payment_status .'<br/>'. 'Total Amount:' .' '  .'$'.$cart->checkout_price,
            'url' => url('/admin/deals/'),
            'text' => 'Approve / Deny Deal!',
            'notifyto' => $author
        ];
        $author->notify(new NewDeal($dealviewdata, $session, $pdf));
        }

        //Notification to Advertiser who created a deal
        $advertiser = User::where('id' , Auth::user()->id)->where('role', '3')->first();
        $advertiser_name = $advertiser->lname;
        $dealname = $cart->title;

        $advertiserdealdata = [
            'subject' => $dealname . ' deal has created!',
            'greeting' => 'Hello' . ' ' . $advertiser_name,
            'body' => 'A new Deal has created.',
            'lineName' => 'Deal Name: ' .  $dealname ,
            'lineStatus' => ' Payment Status: ' . $session->payment_status .'<br/>'. 'Total Amount:' .' '  .'$'.$cart->checkout_price,
            'url' => url('/advertiser/deals/'),
            'text' => 'View Detail!',
            'notifyto' => $advertiser
        ];
        $advertiser->notify(new NewDeal($advertiserdealdata, $session, $pdf));

    }


    public static function new_deal_to_approve_checkout_all($cart)
    {
        $authors = User::where('role', '1')->get();
        foreach ($authors as $author) {
            $author_name = $author->lname;
            $dealname = $cart->title;
            $dealviewdata = [
                'subject' => $dealname . ' waiting for your approval!',
                'greeting' => 'Hello' . ' ' . $author_name,
                'body' => 'A new Deal Waiting for your approval.',
                'lineName' => 'Deal Name: ' .  $dealname ,
                'lineStatus' => ' Payment Status: ',
                'url' => url('/admin/deals/'),
                'text' => 'Approve / Deny Deal!',
                'notifyto' => $author
            ];

            $author->notify(new NewDeal($dealviewdata));
        }
    }

    public static function new_free_deal_to_approve($cart)
    {
        $authors = User::where('role', '1')->get();
        foreach ($authors as $author) {
        $author_name = $author->lname;
        $dealname = $cart->title;
        $dealviewdata = [
            'subject' => $dealname . ' waiting for your approval!',
            'greeting' => 'Hello' . ' ' . $author_name,
            'body' => 'A new Deal Waiting for your approval.',
            'lineName' => 'Deal Name: ' .  $dealname ,
            'lineStatus' => ' Payment Status: Free Deal with Plan',
            'url' => url('/admin/deals/'),
            'text' => 'Approve / Deny Deal!',
            'notifyto' => $author
        ];

        $author->notify(new NewDeal($dealviewdata));
         }
        //Notification to Advertiser who created a deal
        $advertiser = User::where('id' , Auth::user()->id)->where('role', '3')->first();
        $advertiser_name = $advertiser->lname;
        $dealname = $cart->title;

        $advertiserdealdata = [
            'subject' => $dealname . ' deal has created!',
            'greeting' => 'Hello' . ' ' . $advertiser_name,
            'body' => 'A new Deal has created.',
            'lineName' => 'Deal Name: ' .  $dealname ,
            'lineStatus' => 'Payment Status: Free Deal with Plan',
            'url' => url('/advertiser/deals/'),
            'text' => 'View Detail!',
            'notifyto' => $advertiser
        ];
        $advertiser->notify(new NewDeal($advertiserdealdata));
    }

    public static function plan_payment($session)
    {
        $authors = User::where('role', '1')->get();
        foreach ($authors as $author) {
        $author_name = $author->lname;
        $dealviewdata = [
            'subject' => 'Payment done for Plan subscription!',
            'greeting' => 'Hello' . ' ' . $author_name,
            'body' => 'An Advertiser paid plan subscription fee.',
            'lineStatus' => ' Payment Status: ' . $session->payment_status,
            'url' => url('/admin/advertiser-list/'),
            'text' => 'Check Payment Details!',
            'notifyto' => $author
        ];

        $author->notify(new PlanPayment($dealviewdata));
         }
        //Notification to Advertiser who paid plan suscription fee
        $advertiser = User::where('id' , Auth::user()->id)->where('role', '3')->first();
        $advertiser_name = $advertiser->lname;
        $advertiserdealdata = [
            'subject' => 'Payment done for Plan subscription!',
            'greeting' => 'Hello' . ' ' . $advertiser_name,
            'body' => $advertiser_name . ' paid plan subscription fee.',
            'lineStatus' => ' Payment Status: ' . $session->payment_status,
            'url' => url('/advertiser/deals/'),
            'text' => 'Check Payment Details!',
            'notifyto' => $advertiser
        ];
        $advertiser->notify(new PlanPayment($advertiserdealdata));
    }

    public static function deal_approved($deal, $author)
    {
        $author_name = $author->fname . ' ' . $author->lname;
        $dealname = $deal->title;
        $dealviewdata = [
            'subject' => $dealname . ' has been approved!',
            'greeting' => 'Hello' . ' ' . $author_name,
            'body' => 'Your Deal ' . $dealname . ' has been approved by Admin.',
            'url' => url('/advertiser/deals/'),
            'text' => 'View Deals!',
            'notifyto' => $author
        ];

        $author->notify(new DealApproved($dealviewdata));
    }
    
    public static function deal_update($deal)
    {
        $authors = User::where('role', '1')->get();
        foreach ($authors as $author) {
        // $author_name = $author->lname;
        $author_name = $author->fname . ' ' . $author->lname;
        $dealname = $deal->title;
        $dealviewdata = [
            'subject' => $dealname . ' has been Updated!',
            'greeting' => 'Hello' . ' ' . $author_name,
            'body' => $dealname . ' has been Updated.',
            'url' => url('/admin/deals/'),
            'text' => 'View Deals!',
            'notifyto' => $author
        ];
        $author->notify(new UpdateDeal($dealviewdata));
    }
    }


    public static function deal_denied($deal, $author)
    {
        $author_name = $author->fname . ' ' . $author->lname;
        $dealname = $deal->title;
        $dealviewdata = [
            'subject' => $dealname . ' has been denied!',
            'greeting' => 'Hello' . ' ' . $author_name,
            'body' => 'Your Deal ' . $dealname . ' has been denied by Admin.',
            'url' => url('/advertiser/deals/'),
            'text' => 'Check Admin Comment!',
            'notifyto' => $author
        ];

        $author->notify(new DealApproved($dealviewdata));
    }

    public function MarkAsRead (Request $request, $id)
    {
        if($request->ajax()){
        DB::update('update notifications set read_at = ? where id = ?', [now(),$id]);
        return response()->json(['success' => true]);
        }
    }
}
