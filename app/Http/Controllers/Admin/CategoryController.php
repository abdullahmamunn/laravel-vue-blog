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

    public function show($id)
    {
        $categories = Category::find($id);
        if ($categories){
            return response()->json($categories,200);
        }
        else{
            return response()->json(['message'=>"category not found"],200);
        }
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
       $categories = Category::find($id);
       $categories->name = $request->name;
       $categories->slug = Str::slug($request->name,'-');
       $categories->description = $request->description;
       $categories->status = $request->status;
       if ($categories->save()){
           return response()->json(['message'=>'Category Updated successfully'],200);
       }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
    }
}
