<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
   public function store(Request $request){
    //    dd('hi');
    $request->validate([
        'name' => 'required|string'
    ]);
    // $category = Category::create($request->name);
    $category = Category::create(['name' => $request->name]);
    Log::info('Category created successfully:', ['category' => $category]);


    return response()->json($category, 201);
   }

    public function index(){
     $categories = Category::all();

     return response()->json($categories, 200);
    }
}
