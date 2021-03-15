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
                         ->paginate(3);
        return response()->json($all_posts,200);
    }
    public function showCategories()
    {
        $show_categories = Category::where('status',1)->get();
        return response()->json($show_categories,200);
    }
}
