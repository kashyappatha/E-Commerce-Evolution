<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
// use App\Models\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    public function index(Request $request)
    {
        $product = Product::orderBy('created_at', 'DESC')->get();

        return view('products.index', compact('product'));


        if ($request->has('search')) {
            $search = $request->search;
            $product->where('title', 'like', "%$search%");
        }

        $product = $product->paginate(10);

        // return view('categories.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request){
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);
        $product = $category->products()->create([
            'category_id'=>$validatedData['category_id'],
            'title'=>$validatedData['title'],
            'small_description'=>$validatedData['small_description'],
            'description'=>$validatedData['description'],
            'quantity'=>$validatedData['quantity'],
            'status'=>$request->status == true ? '1':'0',


        ]);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/products/';

            foreach($request->file('image') as $imageFile){
                $extention = $imageFile->getClientOrignalExtension();
                $filename = time().'.'.$extention;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName = $uploadPath.'-'.$filename;
                $product->productImages()->create([
                    'product_id'=> $product->id,
                    'image'=> $finalImagePathName,
                ]);
            }
        }

        return redirect('admin/products')->with('message','Product Added Sucsessfully');

        // return $product->id;

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);



        $product->update($request->all());
        // dd($product->toArray());

        return redirect()->route('products')->with('success', 'product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products')->with('success', 'product deleted successfully');
    }
}