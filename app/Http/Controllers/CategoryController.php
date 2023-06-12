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


    public function index(Request $request)
{
    $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');

        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
        $columnIndex = null;
        $columnName = null;
        $columnSortOrder = null;
        $searchValue = null;

        if (!empty($columnIndex_arr) && isset($columnIndex_arr[0]['column'])) {
            $columnIndex = $columnIndex_arr[0]['column'];
        }

        if (!empty($columnName_arr) && isset($columnName_arr[$columnIndex]['data'])) {
            $columnName = $columnName_arr[$columnIndex]['data'];
        }

        if (!empty($order_arr) && isset($order_arr[0]['dir'])) {
            $columnSortOrder = $order_arr[0]['dir'];
        }

        if (!empty($search_arr) && isset($search_arr['value'])) {
            $searchValue = $search_arr['value'];
        }

        // Total records
        $totalRecords = Category::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Category::select('count(*) as allcount')->where('category', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $categories = Category::orderBy('categories.id', "desc")
            ->where('category', 'like', '%' . $searchValue . '%')
            ->select('categories.*')
            ->take($start)
            ->take($rowperpage)
            ->get();

        $data = array();
        $counter = 0;
        foreach ($categories as $category) {

            if($category['status'] == '1')
            {
                $status = '<span class="badge rounded-pill text-bg-success">Active</span>';
            }
            else
            {
                $status = '<span class="badge rounded-pill text-bg-danger">Inactive</span>';
            }

            $row = array();
            $row[] = ++$counter;

            $row[] = $category['category'];

            $row[] = $status;

            $Action = '';



                $Action .= '<a href="' . route(('categories.edit'), [$category["id"]]) . '">;';





                $Action .= '<a href="' . route(('categories.show'), [$category["id"]]) . '">';





                $Action .= '<a data-id="' . $category["id"] . '" href="' . route("categories.destroy", ["id" => $category["id"]]) . '" class="deleteRecord"><i class="fa-regular fa-trash-can"></i></a>&nbsp;&nbsp;&nbsp;';



            $row[] = $Action;
            $data[] = $row;
        }

        $output = array(
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecordswithFilter,
            "data" => $data,
        );

        echo json_encode($output);
        exit;



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