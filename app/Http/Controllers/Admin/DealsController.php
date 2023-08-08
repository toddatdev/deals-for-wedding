<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deals;
use App\Models\Category;
use App\Models\State;
use Illuminate\Support\Facades\Validator;
use URL;
use App;
use App\Http\Controllers\NotificationController;
use App\Models\User;
use App\Models\UserDeal;
use App\Models\UserDealReview;
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
        'city' => 'required|string',
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
        $deals = Deals::with('user', 'category', 'state')->get();
        $cities = State::get();
        // dd($deals->toArray());
        return view('admin.deals.listing', compact('deals', 'cities'));
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
        return view('admin.deals.create', compact('categories', 'states'));
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
                'city'     => $request->city,
                'state_id'     => $request->state_id,
                'category_id'     => $request->category_id,
                'price'     => number_format($request->price, '2', '.', ''),
                'offer_price'     => isset($request->offer_price) ? number_format($request->offer_price, '2', '.', '') : null,
                'status'     => $request->status,
                'is_featured'     => $request->is_featured,
                'user_id'     => Auth::user()->id,
            ]);
            return redirect()->route('deals.index')->with('success', 'Deal has been saved successfully.');

        } catch (\Throwable $e) {

            dd($e->geMessage());

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
        $deal = Deals::with('user', 'category', 'state')->where('id', $id)->first();
        return view('admin.deals.edit', compact('categories', 'states', 'deal'));
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
        // dd($request->all());
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
            $deal->city    = $request->city;
            $deal->state_id   = $request->state_id;
            $deal->category_id    = $request->category_id;
            $deal->price    = number_format($request->price, '2', '.', '');
            $deal->offer_price    = isset($request->offer_price) ? number_format($request->offer_price, '2', '.', '') : null;
            $deal->status    = $request->status;
            $deal->is_featured    = $request->is_featured;
            $deal->user_id    = Auth::user()->id;
            $deal->save();

            return redirect()->route('deals.index')->with('success', 'Deal has been updated successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

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
//        return redirect()->route('deals.index')->with('success', 'Deal has been deleted successfully.');
        return redirect()->back()->with('success', 'Deal has been deleted successfully.');
    }

    public function approve($id)
    {
        $deal = Deals::where('id', $id)->first();
        $deal->update(['status'=> '1']);
        $author = User::where('id', $deal->user_id)->first();

        NotificationController::deal_approved($deal,$author);

        return redirect()->route('deals.index')->with('success', 'Deal has been approved successfully.');
        //return response()->json($deal->user_id);
    }
    public function deny(Request $request, $id)
    {
        $deal = Deals::where('id', $id)->first();
        $deal->update(['status' => '0', 'admin_comment' => $request->admin_comment]);
        $author = User::where('id', $deal->user_id)->first();
        NotificationController::deal_denied($deal,$author);
        //Deals::where('id', $id)->update(['status' => '0', 'admin_comment' => $request->admin_comment]);
        return redirect()->route('deals.index')->with('success', 'Deal has been denied successfully.');
    }

    public function generateSlug($title)
    {
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));
        $count = Category::where('slug', 'LIKE',  '%' . $slug . '%')->get()->count();

        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }
}
