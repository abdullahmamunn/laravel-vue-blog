<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category','user')
            ->orderBy('created_at','DESC')
            ->paginate(5);
       return response()->json($posts,200);

   }

    public function showCategories()
    {
        $show_categories = Category::where('status',1)->get();
        return response()->json($show_categories,200);

    }

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'title'=>'required|max:100',
            'description'=>'required',
            'category_id'=>'required',
            'status'=>'required'
        ]);
        $x = explode(';',$request->thumbnail);
        $xx = explode('/',$x[0]);
        $img_ex = end($xx);
        $slug = Str::slug($request->title);
        $image_name = $slug.'.'.$img_ex;

        Post::create([
            'category_id'=>$request->category_id,
            'content' => $request->description,
            'user_id'=>Auth()->user()->id,
            'status' => $request->status,
            'title' => $request->title,
            'thumbnail'=>$image_name

        ]);

        Image::make($request->thumbnail)->resize(700, 250)->save(public_path('uploads/posts/') . $image_name);

        return response()->json(['message'=>'Post created'],200);

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

    public function deleteAllPosts(Request $request)
    {
        $sl = 0;
        foreach ($request->data as $id)
        {
            $category = Post::find($id);
            $category->delete();
            $sl++;
        }
        $success = $sl > 0 ? true: false;
        return response()->json(['message'=>$success, 'total_deleted'=>$sl],200);
    }

    public function statusChange(Request $request)
    {
        $sl = 0;
        foreach ($request->data as $id)
        {
            $category = Post::find($id);
            $category->status = $request->status;
            $category->save();
            $sl++;
        }
        $success = $sl > 0 ? true: false;
        return response()->json(['message'=>$success, 'total'=>$sl],200);
    }
}
