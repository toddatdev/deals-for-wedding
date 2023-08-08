<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Page;
use App\Models\Faq;
use App\Models\User;
use Mail;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
	public function index()
	{
		if (Auth::check()) {
			return redirect('/deals');
		} else {
			return view('front.index');
		}
	}

	//login form
	public function ohHeyThere()
	{
		return view('front.oh-hey-there');
	}

	//privacy policy
	public function privacy_policy()
	{
		$data = Page::where('page_key', 'privacy_policy')->first();
		return view('front.privacy_policy', compact('data'));
	}

	//about us
	public function about_us()
	{
		$data = Page::where('page_key', 'about_us')->first();
		return view('front.about_us', compact('data'));
	}

	//privacy policy
	public function term_conditions()
	{
		$data = Page::where('page_key', 'term_conditions')->first();
		return view('front.term_conditions', compact('data'));
	}

	//faq
	public function faqs()
	{
		$vendor_faq = Faq::where('category', 'vendor_faq')->where('status', 1)->get();
		$user_faq = Faq::where('category', 'user_faq')->where('status', 1)->get();
		return view('front.faq', compact('user_faq', 'vendor_faq'));
	}

	//contact form
	public function contact()
	{
		return view('front.contact');
	}

	public function contact_support(Request $request)
	{
		$requestData = $request->all();
		// dd(implode(',', $request->contact_type));
		$validator = Validator::make($request->all(), [
			'g-recaptcha-response' => 'required',
		]);
		if($validator->fails()){
            return redirect()->back()->with('error', 'Please complete reCaptcha!')->withInput();
        }
		else {
			try {
				//  Send mail to admin

				\Mail::send('emails.contact_query', array(

					'email' => $request->email,
					'name' => $request->name,
					'phone' => $request->phone,
					'contact_type' => implode(',', $request->contact_type),
					'subject' => $request->subject,
					'comment' => $request->message,

				), function ($message) use ($request) {
					$admins = User::where('role', 1)->get();
					foreach ($admins as $admin) {
					$message->from('no-reply@dealsforweddings.com', 'Contact Support');

					$message->to($admin->email)->subject('Contact Us Form Query');
					}

					
				});

				return redirect()->route('front.contact')->with('success', "Message sent successfully");
			} catch (\Throwable $e) {
				return redirect()->back()->with('error', $e->getMessage());
			}
		}
	}
}
