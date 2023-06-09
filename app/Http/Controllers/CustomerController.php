<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::query();

        if ($request->has('search')) {
            $search = $request->search;
            $customers->where('customer', 'like', "%$search%");
        }

        $customers = $customers->paginate(10);

        return view('customers.index', compact('customers'));
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
            $query->where('customer', 'like', '%' . $search . '%');
        }

        $categories = $query->paginate(10);

        return view('customer', compact('categories'));
    }
}