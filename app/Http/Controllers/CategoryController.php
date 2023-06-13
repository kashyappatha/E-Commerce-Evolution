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

    public function category()
    {
        return view('categories.index');
    }


    public function getcategory(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');

        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

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

                $row[] = '<img src="' . asset('admin_assets/img/' . $category->image) . '" alt="Image" style="max-width: 70px; border-radius: 10px;">';


                $row[] = $status;

                $Action = '';

                $Action .= '<a href="' . route(('categories.edit'), [$category["id"]]) . '">&nbsp;<i class="fas fa-edit"></i>|';

                $Action .= '<a href="' . route(('categories.show'), [$category["id"]]) . '">&nbsp;<i class="fas fa-eye"></i>|';

                $Action .= '<a data-id="' . $category["id"] . '" href="' . route("categories.destroy", ["id" => $category["id"]]) . '" onclick="event.preventDefault(); deleteCategory(' . $category["id"] . ')"><i class="fas fa-trash-alt"></i></a>';

                // JavaScript code for the SweetAlert confirmation dialog
                $Action .= '
                <script>

                    function deleteCategory(id) {
                        Swal.fire({
                            title: "Are you sure?",
                            text: "You Want to delete the category!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!",

                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Perform the delete action here
                                window.location.href = "' . route("categories.destroy", ["id" => $category["id"]]) . '?id=" + id;
                            }
                        });
                    }
                </script>';



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
