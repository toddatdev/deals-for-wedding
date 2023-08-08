<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog\Category;
use App\Blog\Post;
use App\Blog\Comments;
use DB;
use Session;
use File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts         = Post::with('category','comments')->orderBy('created_at', 'DESC')->paginate(20);
        //$latest_posts  = Post::with('category')->orderBy('created_at', 'DESC')->take(5)->get();
        //$sidebar_categories = Category::where('status', 1)->get();
        //return view('front.blog.blog',compact('posts','sidebar_categories','latest_posts'));
        $posts = Post::with('category')->orderBy('created_at', 'DESC')->get();
        return view('front.blog.blog',compact('posts'));
    }

    public function view_post($slug)
    {  
        $post = Post::with('category')->where('slug', $slug)->first();
		$latest_posts = Post::with('category')->orderBy('created_at', 'DESC')->take(3)->get();
		//$sidebar_categories = Category::where('status', 1)->get();
		//$comments = Comments::where('post_id', $post->id)->get();
	   // return view('front.blog.post_detail',compact('post','sidebar_categories','latest_posts','comments'));
        return view('front.blog.post_detail',compact('post','latest_posts'));
			
        
    }

    public function view_category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if(!empty($category)){
            $posts = Post::with('category','comments')->where('category_id', $category->id)->orderBy('created_at', 'DESC')->paginate(20);
            $latest_posts = Post::with('category')->orderBy('created_at', 'DESC')->take(5)->get();
            $sidebar_categories = Category::where('status', 1)->get();
            return view('front.blog.post_category',compact('posts','sidebar_categories','latest_posts'));
        }else{
            abort(404);
        }
    }

    public function post_comment(Request $request)
    {
        // dd($request->all());
        $post = Post::findorfail($request->post_id);
        $comment = new Comments([
                                'name'         => isset($request->author) ? $request->author : null,
                                'email'   => isset($request->email) ? $request->email : null,
                                'comment'         => isset($request->comment) ? $request->comment : null,
                                'post_id'        => isset($request->post_id) ? $request->post_id : 1,
                            ]);
        try{
            $comment->save();
            return redirect()->route('blog.view_post', $post->slug)->with('flash_message','Comment has been posted successfully.');
        }catch(\Throwable $e){
             return redirect()->back()->with("error",$e->getMessage());
        }
    }
}