<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Productimage;
use Illuminate\Support\Facades\File;
// use Symfony\Component\HttpFoundation\File\File;

// use App\Models\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

//     public function index(Request $request)
//     {
// //         $product = Product::orderBy('created_at', 'DESC')->get();
//         $products=Product::all();

//         return view('products.index', compact('products'));
//     }
public function product()
    {
        return view('products.index');
    }


    public function getproduct(Request $request)
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
            $totalRecords = Product::select('count(*) as allcount')->count();
            $totalRecordswithFilter = Product::select('count(*) as allcount')->where('category_id', 'like', '%' . $searchValue . '%')->count();

            // Fetch records
            $categories = Product::orderBy('products.id', "desc")
                ->where('category_id', 'like', '%' . $searchValue . '%' )
                ->select('products.*')
                ->take($start)
                ->take($rowperpage)
                ->get();

            $data = array();
            $counter = 0;
            foreach ($categories as $product) {

                if ($product['status'] == '1')
                {
                    $status = '<span class="badge rounded-pill text-success bg-success text-light"> <i class="fas fa-check-circle me-1">Active</i></span>';
                } else
                {
                    $status = '<span class="badge rounded-pill text-danger bg-danger text-light"><i class="fas fa-check-circle me-0">InActive</i></span>';
                }


                $row = array();
                $row[] = ++$counter;

                // $row[] = $product[$category_id. '->' . $category->category];
                $category = Category::find($product->category_id);
                $categoryName = $category ? $category->category : 'N/A';


                $row[] = $categoryName;
                $row[] = '<img src="' . asset($product->images) . '" alt="Image" style="max-width:100px; border-radius:10px;">';
                $row[] = $product['title'];
                // $row[]= $product['image'];
                $row[] = $product['brand'];
                $row[] = $product['small_description'];
                $row[] = $product['description'];
                $row[] = '&#8377; ' . $product['orignal_price'];
                $row[] = '&#8377; ' . $product['selling_price'];

                $row[] = $product['quantity'];
                $row[] = '<span style="display: inline-block; padding: 5px px; background-color: red; border-radius: 20px; font-weight: bold; color: white; margin-right: 5px; width: 90px;">
                <i class="fas fa-barcode" style="margin-left: 6px;color: white;"></i>' . $product['product_code'] . '
            </span>';








                $row[] = $status;



                // $row[] = '<img src="' . asset('admin_assets/img' . $product->image) . '" alt="Image" style="max-width: 70px; border-radius: 10px;">';

                $Action = '';

                $Action .= '<a href="' . route(('products.edit'), [$product["id"]]) . '">&nbsp;<i class="fas fa-edit"></i>|';

                $Action .= '<a href="' . route(('products.show'), [$product["id"]]) . '">&nbsp;<i class="fas fa-eye"></i>|';

                $Action .= '<a data-id="' . $product["id"] . '" href="' . route("products.destroy", ["id" => $product["id"]]) . '" onclick="event.preventDefault(); deleteCategory(' . $product["id"] . ')"><i class="fas fa-trash-alt"></i></a>';

                // JavaScript code for the SweetAlert confirmation dialog
                $Action .= '
                <script>

                    function deleteCategory(id) {
                        Swal.fire({
                            title: "Are you sure?",
                            text: "You Want to delete the product!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!",

                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Perform the delete action here
                                window.location.href = "' . route("products.destroy", ["id" => $product["id"]]) . '?id=" + id;
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
    // public function store(Request $request) {

    //     // dd($request->image);

    //     // $product = Product::create([
    //     //     'category_id'=>$request->category_id,
    //     //     'images'=>$request->images,
    //     //     'title'=>$request->title,
    //     //     'brand'=>$request->brand,
    //     //     'small_description'=>$request->small_description,
    //     //     'description'=>$request->description,
    //     //     'orignal_price'=>$request->orignal_price,
    //     //     'selling_price'=>$request->selling_price,
    //     //     'product_code'=>$request->product_code,
    //     //     'quantity'=>$request->quantity,
    //     //     'status'=>$request->status == true ? '1':'0'
    //     // ]);

    //     // foreach($request->image as $imageFile){


    //     //     Productimage::create([

    //     //         'product_id' => $product->id,
    //     //         'image' => $imageFile

    //     //     ]);

    //     // }
    //     $request->validate([
    //         'category_id' => 'required',
    //         'images' => 'required',
    //         'title' => 'required',
    //         'brand' => 'required',
    //         'image.*' => 'required',
    //         'small_description' => 'required',
    //         'description' => 'required',
    //         'orignal_price' => 'required',
    //         'selling_price' => 'required',
    //         'product_code' => 'required',
    //         'quantity' => 'required',
    //         'status' => 'required',
    //     ]);

    //     $product = new Product;
    //     $status = $request->has('status') ? 1 : 0;
    //     $product->category_id = $request->category_id;

    //     if ($request->hasFile('images')) {
    //         dd($request->hasFile('images'));
    //         exit;
    //         $file = $request->file('images');
    //         $imageName = time() . '_' . $file->getClientOriginalName();
    //         $file->move(public_path('Product_thumbnails'), $imageName);
    //         $product->images = 'Product_thumbnails/'.$imageName;
    //     }

    //     $product->title = $request->title;
    //     $product->brand = $request->brand;
    //     $product->small_description = $request->small_description;
    //     $product->description = $request->description;
    //     $product->orignal_price = $request->orignal_price;
    //     $product->selling_price = $request->selling_price;
    //     $product->product_code = $request->product_code;
    //     $product->quantity = $request->quantity;
    //     $product->status = $status;
    //     $product->save();

    //     if ($request->hasFile("image")) {
    //         foreach ($request->file("image") as $file) {
    //             $imageName = time() . '_' . $file->getClientOriginalName();
    //             $file->move(public_path("uploaded_images"), $imageName);
    //             $productImage = new Productimage;
    //             $productImage->product_id = $product->id;
    //             $productImage->image = 'uploaded_images/'.$imageName;
    //             $productImage->save();
    //         }

    //     }
    //     // return redirect()->route('/getproduct')
    //     //     ->with('success', 'Product created successfully.');

    //     // return redirect('admin/products')->with('message','Product Added Sucsessfully');
    // }

    // /**
    //  * Display the specified resource.
    //  */

    public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required',
        'images' => 'required',
        'title' => 'required',
        'brand' => 'required',
        'small_description' => 'required',
        'description' => 'required',
        'orignal_price' => 'required',
        'selling_price' => 'required',
        'product_code' => 'required',
        'quantity' => 'required',
        'status' => 'required',
    ]);

    $product = new Product;
    $status = $request->has('status') ? 1 : 0;
    $product->category_id = $request->category_id;

    // Upload and store thumbnail image
    if ($request->hasFile('images')) {
        $file = $request->file('images');
        $thumbnailName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('Product_thumbnails'), $thumbnailName);
        $product->images = 'Product_thumbnails/' . $thumbnailName;
    }

    $product->title = $request->title;
    $product->brand = $request->brand;
    $product->small_description = $request->small_description;
    $product->description = $request->description;
    $product->orignal_price = $request->orignal_price;
    $product->selling_price = $request->selling_price;
    $product->product_code = $request->product_code;
    $product->quantity = $request->quantity;
    $product->status = $status;
    $product->save();

    // Upload and store product images
    if ($request->hasFile("image")) {
        foreach ($request->file("image") as $file) {
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path("uploaded_images"), $imageName);
            $productImage = new Productimage;
            $productImage->product_id = $product->id;
            $productImage->image = 'uploaded_images/' . $imageName;
            $productImage->save();
        }
    }

    return redirect()->route('products')->with('success', 'Product created successfully.');
}

    public function show(int $product_id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($product_id);


        return view('products.show', compact('product','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $product_id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($product_id);

        return view('products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, int $product_id)
    {
        $request->validate([
            'category_id' => 'required',
            'images' => 'required',
            'title' => 'required',
            'brand' => 'required',
            'small_description' => 'required',
            'description' => 'required',
            'orignal_price' => 'required',
            'selling_price' => 'required',
            'product_code' => 'required',
            'quantity' => 'required',
            'status' => 'required',
        ]);

        $product = Product::find($product_id);

        if ($product) {
            $status = $request->has('status') ? 1 : 0;
            $product->category_id = $request->category_id;

            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $thumbnailName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('Product_thumbnails'), $thumbnailName);
                $product->images = 'Product_thumbnails/' . $thumbnailName;
            }

            $product->title = $request->title;
            $product->brand = $request->brand;
            $product->small_description = $request->small_description;
            $product->description = $request->description;
            $product->orignal_price = $request->orignal_price;
            $product->selling_price = $request->selling_price;
            $product->product_code = $request->product_code;
            $product->quantity = $request->quantity;
            $product->status = $status;
            $product->save();

            if ($request->hasFile('image')) {
                $uploadPath = 'admin_assets/img';
                $i = 1;
                foreach ($request->file('image') as $imageFile) {
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time() . $i++ . '.' . $extension;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath . '/' . $filename;
                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }

            return redirect('admin/products')->with('message', 'Product Updated Successfully');
        } else {
            return redirect('admin/products')->with('message', 'No such Product ID Found');
        }
    }

    public function destroyImage(int $product_image_id){
        $productImage = ProductImage::findOrFail($product_image_id);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);

        }
        $productImage->delete();

    return redirect()->back()->with('message', 'Product Image Deleted');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        if($product->productImages()){
            foreach($product->productImages() as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);

                }
            }
        }

        $product->delete();

        return redirect('')->back()->with('success', 'product deleted with all its image');
    }
    public function deleteImage(int $product_id)

    {
    $product = Product::findOrFail($product_id);

    if ($product->images) {
        // Delete the image file from the server
        $imagePath = public_path('admin_assets/img/' . $product->images);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Clear the image field in the category record
        $product->images = null;
        $product->save();

        return response()->json(['success' => true]);
    }
}
// public function deleteImage1(int $product_id)

// {
// $product = Product::findOrFail($product_id);

// if ($product->image) {
//     // Delete the image file from the server
//     $imagePath = public_path('admin_assets/img/' . $product->image);
//     if (File::exists($imagePath)) {
//         File::delete($imagePath);
//     }

//     // Clear the image field in the category record
//     $product->image = null;
//     $product->save();

//     return response()->json(['success' => true]);
// }
// }



}