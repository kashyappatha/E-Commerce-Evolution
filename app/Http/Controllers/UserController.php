<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use  Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class UserController extends Controller
{
    public function user()
    {
        return view('users.index');
    }
    public function getuser(Request $request)
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
            $totalRecords = User::select('count(*) as allcount')->count();
            $totalRecordswithFilter = User::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%')->count();

            // Fetch records
            $categories = User::orderBy('users.id', "desc")
                ->where('name', 'like', '%' . $searchValue . '%')
                ->select('users.*')
                ->take($start)
                ->take($rowperpage)
                ->get();

            $data = array();
            $counter = 0;
            foreach ($categories as $user) {



                $row = array();
                $row[] = ++$counter;


                $row[] = '<img src="' . asset('admin_assets/img/' . $user->profile_image) . '" alt="Image" style="max-width: 60px; border-radius: 30px;">';
                $row[] = $user['name'];
                $row[] = $user['email'];
                // $row[] = $user['password'];
                $Action = '';

                $Action .= '<a href="' . route(('users.edit'), [$user["id"]]) . '">&nbsp;<i class="fas fa-edit"></i>|';

                $Action .= '<a href="' . route(('users.show'), [$user["id"]]) . '">&nbsp;<i class="fas fa-eye"></i>|';


                $Action .= '<a data-id="' . $user["id"] . '" href="' . route("users.destroy", ["id" => $user["id"]]) . '" onclick="event
                .preventDefault(); deleteUser(' . $user["id"] . ')"><i class="fas fa-trash-alt"></i></a>';

                // JavaScript code for the SweetAlert confirmation dialog
                $Action .= '
                <script>

                    function deleteUser(id) {
                        Swal.fire({
                            title: "Are you sure?",
                            text: "You Want to Remove the User !",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, remove it!",

                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Perform the delete action here
                                window.location.href = "' . route("users.destroy", ["id" => $user["id"]]) . '?id=" + id;
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

    public function create(Request $request)
    {
        // Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => [
        //         'required',
        //         'confirmed',
        //         'min:8',
        //         // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/u'
        //     ],
        // ])->validate();

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'level' => 'User',
        // ]);

        return view('users.create');
    }

    public function edit(Request $request ,$id)
    {
        // Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => [
        //         'required',
        //         'confirmed',
        //         'min:8',
        //         // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/u'
        //     ],
        // ])->validate();

        // $user = User::findOrFail($id);
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // // $user->save();
        // $user = User::findOrFail($id);
        // $user->edit($request->all());

        // return redirect('/admin/users/edit/')->route('users')->with('success', 'User added successfully');
        $user = User::findOrFail($id); // Fetch the user by ID

        // Rest of your code to update the user

        return view('users.edit', compact('user'));    }
    public function update(Request $request , string $id)
    {

        $user = User::findOrFail($id);

        $user->update($request->all());

        return redirect()->route('users')->with('success', 'user updated successfully');
    }
    public function store(Request $request)
    {
        User::create($request->all());

        return redirect()->route('users')->with('success', 'User added successfully');

    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'user deleted successfully');
    }
    public function deleteImage($id)
{
    $user = User::findOrFail($id);

    if ($user->profile_image) {
        // Delete the image file from the server
        $imagePath = public_path('admin_assets/img/' . $user->profile_image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Clear the image field in the category record
        $user->profile_image = null;
        $user->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}

}