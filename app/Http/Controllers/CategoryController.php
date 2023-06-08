<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use  Illuminate\Database\Eloquent\Collection;
// use  Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;



class CategoryController extends Controller
{

    // public function index()
    // {
    //     $category = Category::orderBy('created_at', 'DESC')->get();

    //     return view('categories.index', compact('category'));

    // }
    public function index(Request $request)
{
    $category = Category::orderBy('created_at', 'DESC');

    if ($request->has('search')) {
        $search = $request->search;
        $category->where('category', 'like', "%$search%");
    }

    $category = $category->paginate(10);

    return view('categories.index', compact('category'));
}

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        Category::create($request->all());

        return redirect()->route('categories')->with('success', 'Category added successfully');
    }

    public function show(string $id)
    {

        $category = Category::findOrFail($id);

        return view('categories.show', compact('category'));

    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request , string $id)
    {

        $category = Category::findOrFail($id);

        $category->update($request->all());

        return redirect()->route('categories')->with('success', 'category updated successfully');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('categories')->with('success', 'category deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = Category::query();

        if ($search) {
            $query->where('category', 'like', '%' . $search . '%');
        }

        $categories = $query->paginate(10);

        return view('categories.search_results', compact('categories'));
    }

public function deleteImage($id)
{
    $category = Category::findOrFail($id);

    if ($category->image) {
        // Delete the image file from the server
        $imagePath = public_path('admin_assets/img/' . $category->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Clear the image field in the category record
        $category->image = null;
        $category->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}

}