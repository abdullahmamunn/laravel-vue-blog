<?php

namespace App\Http\Controllers;

use App\Post;
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
}
