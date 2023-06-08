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
    public function index()
    {
        $users = User::all(); // Or use any other logic to fetch the users
        $users = User::paginate(10);


        return view('users.index', compact('users'));
        // return view('users.index');
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

    public function edit(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/u'
            ],
        ])->validate();

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // return redirect()->route('users.index');
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

        // return redirect()->route('users.index');
    }

}