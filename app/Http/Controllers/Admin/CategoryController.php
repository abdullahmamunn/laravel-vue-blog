<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json(['categories'=>$categories],200);
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
        'slug' => $request->name,
        'description' => $request->description,
        'status' => $request->status,
      ]);

    }
}
