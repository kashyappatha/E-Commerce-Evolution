<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use  Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use  Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\File;

class CustomerController extends Controller
{
    public function index(){
        // $customers = Customer::all();

       // Or use any other logic to fetch the users

       $customers = Customer::paginate(10);

        // $customer = $customer->paginate(10);
        return view('customers.index' ,compact('customers'));

    }

    public function create(){
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

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request , string $id)
    {

        $customer = Customer::findOrFail($id);

        $customer->update($request->all());

        return redirect()->route('customers')->with('success', 'customers updated successfully');
    }


    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect()->route('customers')->with('success', 'customers deleted successfully');
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


}