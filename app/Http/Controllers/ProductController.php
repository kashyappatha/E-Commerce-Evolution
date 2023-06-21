<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;
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
                ->where('category_id', 'like', '%' . $searchValue . '%')
                ->select('products.*')
                ->take($start)
                ->take($rowperpage)
                ->get();

            $data = array();
            $counter = 0;
            foreach ($categories as $product) {

                if ($product['status'] == '1')
                {
                    $status = '<span class="badge rounded-pill text-success bg-success text-light">Hidden</span>';
                } else
                {
                    $status = '<span class="badge rounded-pill text-danger bg-danger text-light">Visible</span>';
                }


                $row = array();
                $row[] = ++$counter;

                $row[] = $product['category_id'];
                $row[] = $product['title'];
                $row[] = $product['price'];
                $row[] = $product['small_description'];
                $row[] = $product['description'];
                $row[] = $product['quantity'];
                $row[] = $product['product_code'];


                $row[] = '<img src="' . asset('admin_assets/img/' . $product->image) . '" alt="Image" style="max-width: 70px; border-radius: 10px;">';


                $row[] = $status;

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
    public function store(ProductFormRequest $request){
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);
        $product = $category->products()->create([
            'category_id'=>$validatedData['category_id'],
            'title'=>$validatedData['title'],
            'price'=>$validatedData['price'],
            'small_description'=>$validatedData['small_description'],
            'description'=>$validatedData['description'],
            'quantity'=>$validatedData['quantity'],
            'product_code'=>$validatedData['product_code'],
            'image'=>$validatedData['image'],
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
    public function update(ProductFormRequest $request,int $product_id)
    {
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData['category_id'])->products()->where('id',$product_id)->first();
        if($product){
            $product->update([
                'category_id'=>$validatedData['category_id'],
                'title'=>$validatedData['title'],
                'price'=>$validatedData['price'],
                'small_description'=>$validatedData['small_description'],
                'description'=>$validatedData['description'],
                'quantity'=>$validatedData['quantity'],
                'product_code'=>$validatedData['product_code'],
                'image'=>$validatedData['image'],
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
            return redirect('admin/products')->with('message','Product Updated Succesfully');

        }else{
            return redirect('admin/products')->with('message','No such Product ID Found');

        }

        // $product->update($request->all());

        // return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }
    public function destroyImage(int $product_image_id){
        $productImage = ProductImage::findOrFail($product_image_id);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);

        }
        $productImage->delete();
        return redirect('')->back()->with('message','Product Image Deleted');
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

    if ($product->image) {
        // Delete the image file from the server
        $imagePath = public_path('admin_assets/img/' . $product->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Clear the image field in the category record
        $product->image = null;
        $product->save();

        return response()->json(['success' => true]);
    }
}



}