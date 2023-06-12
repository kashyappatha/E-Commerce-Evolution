<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;



class ProfileController extends Controller
{
    public function profileupdate(Request $request)
    {
        // Validate the request
        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as per your requirements
            // Other fields validation rules
        ]);

        // Check if a new profile image was uploaded
        if ($request->hasFile('profile_image')) {
            // Get the uploaded file
            $profileImage = $request->file('profile_image');

            // Generate a unique name for the image
            $imageName = time() . '_' . uniqid() . '.' . $profileImage->getClientOriginalExtension();

            // Move the uploaded image to the desired directory
            $profileImage->move(public_path('admin_assets/img'), $imageName);

            // Update the user's profile image in the database
            $user = Auth::user();
            $user->profile_image = $imageName;
             $user->save();
        }

        // Update the other profile fields as needed
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    public function storeAvatar(Request $request)
{
    $avatarUrl = $request->input('avatarUrl');

    // Store the avatar URL in the session
    Session::put('default_avatar', $avatarUrl);


    return response()->json(['success' => true]);

    // $avatarUrl->save();
}
}