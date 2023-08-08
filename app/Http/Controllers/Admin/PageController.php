<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy_policy(Request $request)
    {
        $data = Page::where('page_key','privacy_policy')->first();
        $page_title = "Privacy Policy";
        $page_key = "privacy_policy";
        return view('admin.pages.create', compact('data','page_key','page_title'));
    }

    public function about_us(Request $request)
    {
        $data = Page::where('page_key','about_us')->first();
        $page_title = "About Us";
        $page_key = "about_us";
        return view('admin.pages.create', compact('data','page_key','page_title'));
    }

    public function term_conditions(Request $request)
    {
        $data = Page::where('page_key','term_conditions')->first();
        $page_title = "Term and Conditions";
        $page_key = "term_conditions";
        return view('admin.pages.create', compact('data','page_key','page_title'));
    }

    public function save_data(Request $request)
    {
        // dd($request->all());
        try{
            $page = Page::where('page_key',$request->page_key)->first();
            if(!empty($page)){
                Page::where('page_key', $request->page_key)->update([
                    'title'    => $request->title,
                    'content'     => $request->content,
                    'page_key'     => $request->page_key,
                ]);
            }else{
               $save = Page::create([
                    'title'    => $request->title,
                    'content'     => $request->content,
                    'page_key'     => $request->page_key,
                ]); 
            }
            
            return redirect()->back()->with('success','Data has been saved successfully.');
        }catch(\Throwable $e){
             return redirect()->back()->with("error",$e->getMessage());
        }
    }

    
}
