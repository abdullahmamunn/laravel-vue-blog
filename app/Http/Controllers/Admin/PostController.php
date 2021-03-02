<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category','user')->paginate(5);
       return response()->json($posts,200);

   }

    public function showCategories()
    {
        $show_categories = Category::all();
        return response()->json($show_categories,200);

    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->delete()){
            return response()->json(['message'=>'Post deleted successfully'],200);
        }
        else{
            return response()->json(['message'=>'Post Not found'],404);
        }
    }
}
