<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


// use DB;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //     //  $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store','create', 'edit', 'update', 'destroy']]);
    //     $this->middleware('permission:role-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $roles  = Role::all();
       return view('roles.index',compact('roles'));
    }
    public function getroles(Request $request)
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
            $totalRecords = Role::select('count(*) as allcount')->count();
            $totalRecordswithFilter = Role::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%')->count();

            // Fetch records
            $roles = Role::orderBy('roles.id', "desc")
                ->where('name', 'like', '%' . $searchValue . '%')
                ->select('roles.*')
                ->take($start)
                ->take($rowperpage)
                ->get();

            $data = array();
            $counter = 0;
            foreach ($roles as $role) {



                $row = array();
                $row[] = ++$counter;
                // $row[] = '<span class="badge rounded-pill ' . ($role['name'] === 'Admin' ? 'bg-success text-light' : 'bg-success text-light') . '">
                // <i class="fas fa-user"></i>' . $role['name'] . '</span>';
                $row[] = '<span class="badge rounded-pill ' . ($role['name'] === 'Admin' ? 'bg-success text-light' : 'bg-primary text-light') . '">
                <i class="' . ($role['name'] === 'User' ? 'fas fa-user' : 'fas fa-crown') . '"></i>' . $role['name'] . '</span>';


                $Action = '';

                $Action .= '<a href="' . route(('roles.edit'), [$role["id"]]) . '">&nbsp;<i class="fas fa-edit"></i>|';





                // if (Auth::user()->can('role-delete')) {

                    $Action .= '<a href="' . route(('roles.show'), [$role["id"]]) . '">&nbsp;<i class="fas fa-eye"></i>|';

                // }

                $Action .= '<a href="' . route(('roles.destroy'),[$role["id"]]) .'">&nbsp;<i class="fas fa-trash-alt"></i></a>';
                // // JavaScript code for the SweetAlert confirmation dialog
                // $Action .= '
                // <script>

                //     function deleteUser(id) {
                //         Swal.fire({
                //             title: "Are you sure?",
                //             text: "You Want to Remove the User !",
                //             icon: "warning",
                //             showCancelButton: true,
                //             confirmButtonColor: "#3085d6",
                //             cancelButtonColor: "#d33",
                //             confirmButtonText: "Yes, remove it!",

                //         }).then((result) => {
                //             if (result.isConfirmed) {
                //                 // Perform the delete action here
                //                 window.location.href = "' . route("roles.destroy", ["id" => $role["id"]]) . '?id=" + id;
                //             }
                //         });
                //     }
                // </script>';

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
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $roles = Role::all();
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.edit',compact('role','roles','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}