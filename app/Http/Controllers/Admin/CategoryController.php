<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
//        return Category::paginate(3);
        return Category::latest()->paginate(3);
//        return response()->json(['categories'=>$categories],200);
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'description' => 'required',
           'status' => 'required',
        ]);
      Category::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name,'-'),
        'description' => $request->description,
        'status' => $request->status,
      ]);

    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
    }
}
