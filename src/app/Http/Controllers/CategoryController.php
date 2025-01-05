<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();

        return view('category',compact('categories'));
    }

    public function store(Request $request)
    {
        $category = $request->only(['name']);
        Category::create($category);

        return redirect('/categories')->with('message', 'categoryが作成されました！');
    }
}
