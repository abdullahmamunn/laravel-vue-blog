<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $all_posts = Post::with('category','user')
            ->Orwhere('status','published')
            ->orderBy('created_at','desc')
            ->paginate(4);
        return response()->json($all_posts,200);
    }
    public function showCategories()
    {
        $show_categories = Category::where('status',1)->get();
        return response()->json($show_categories,200);
    }
    public function categoryView($slug)
    {

        $category = Category::where('slug',$slug)->first();
        $category_wise_post = Post::with('category','user')
            ->where('status','published')
            ->where('category_id',$category->id)
            ->orderBy('created_at','desc')
            ->get();
        return response()->json($category_wise_post, 200);
    }

    public function singlePostView($id)
    {
        $single_post = Post::find($id);
        return $single_post;
    }
    public function recentPostView($slug)
    {
         $data = Post::where('slug',$slug)->first();
         return $data;
    }
}
