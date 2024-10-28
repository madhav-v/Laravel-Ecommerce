<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function store(ProductRequest $request){

    // dd('hi');
    $productData = $request->only(['name', 'description', 'price', 'category_id']);
    $product = Product::create($productData);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store('products', 'public');

            $product->images()->create(['image_path' => $path]);
        }
    }

    return response()->json(['message' => 'Product created successfully with images', 'product' => $product->load('images')], 201);
   }

    public function index(){
     $products = Product::all();

     $response['data']= ProductResource::collection($products);
        $response['message'] = 'All products fetched successfully';
        return response()->json($response, 200);

    //  return response()->json($products, 200);
    }

    public function search(Request $request){
        $query = $request->input('query');
        if(!$query){
            return response()->json(['message' => 'Search query is required'], 400);
        };

        $products = Product::where('name', 'like', "%$query%")->get();

        $response['data'] = ProductResource::collection($products);

        $response['message'] = 'Products fetched successfully';

        return response()->json($response, 200);
    }

    public function getByCategory($categoryName){
        $category = Category::where('name', $categoryName)->first();
        if(!$category){
            return response()->json(['message' => 'Category not found'], 404);
        }

        $products = $category->products;

        $response['data'] = ProductResource::collection($products);
        $response['message'] = 'Products fetched successfully';

        return response()->json($response, 200);
    }
}
