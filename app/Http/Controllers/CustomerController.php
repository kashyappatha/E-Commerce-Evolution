<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{

    public function customer()
    {
        return view('customers.index');
    }
    public function getcustomer(Request $request)
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
            $totalRecords = Customer::select('count(*) as allcount')->count();
            $totalRecordswithFilter = Customer::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%')->count();

            // Fetch records
            $categories = Customer::orderBy('customers.id', "desc")
                ->where('name', 'like', '%' . $searchValue . '%')
                ->select('customers.*')
                ->take($start)
                ->take($rowperpage)
                ->get();

            $data = array();
            $counter = 0;
            foreach ($categories as $customer) {



                $row = array();
                $row[] = ++$counter;


                $row[] = '<img src="' . asset('admin_assets/img/' . $customer->profile_image) . '" alt="Image" style="max-width: 70px; border-radius: 10px;">';
                $row[] = $customer['name'];
                $row[] = $customer['email'];
                $row[] = $customer['country'];
                $row[] = $customer['state'];
                $row[] = $customer['city'];
                $row[] = $customer['Address_1'];
                $row[] = $customer['Address_2'];
                $row[] = $customer['postalcode'];
                $row[] = $customer['phone'];






                $Action = '';

                $Action .= '<a href="' . route(('customers.edit'), [$customer["id"]]) . '">&nbsp;<i class="fas fa-edit"></i>|';

                $Action .= '<a href="' . route(('customers.show'), [$customer["id"]]) . '">&nbsp;<i class="fas fa-eye"></i>|';

                $Action .= '<a data-id="' . $customer["id"] . '" href="' . route("customers.destroy", ["id" => $customer["id"]]) . '" onclick="event
                .preventDefault(); deleteCustomer(' . $customer["id"] . ')"><i class="fas fa-trash-alt"></i></a>';

                // JavaScript code for the SweetAlert confirmation dialog
                $Action .= '
                <script>

                    function deleteCustomer(id) {
                        Swal.fire({
                            title: "Are you sure?",
                            text: "You Want to Remove the Customer !",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, remove it!",

                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Perform the delete action here
                                window.location.href = "' . route("customers.destroy", ["id" => $customer["id"]]) . '?id=" + id;
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
        return view('customers.create');
    }

    public function store(Request $request)
    {
        Customer::create($request->all());

        return redirect()->route('customers')->with('success', 'Customers added successfully');
    }

    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.show', compact('customer'));
    }

    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);

        // $customer->save();

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);

        $customer->update($request->all());

        return redirect()->route('customers')->with('success', 'Customers updated successfully');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect()->route('customers')->with('success', 'Customers deleted successfully');
    }

    public function deleteImage($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->profile_image) {
            // Delete the image file from the server
            $imagePath = public_path('admin_assets/img/' . $customer->profile_image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            // Clear the image field in the category record
            $customer->profile_image = null;
            $customer->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = Customer::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $categories = $query->paginate(10);

        return view('name', compact('customers'));
    }
}
