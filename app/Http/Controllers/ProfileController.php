<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
// use App\Models\User;



class ProfileController extends Controller
{
    public function incrementChangeCount(Request $request)
    {
        // Perform the increment logic
        $changeCount = session('changeCount', 0);
        $changeCount++;
        session(['changeCount' => $changeCount]);

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }
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

public function deleteImage($userId)
{
    // Retrieve the user's profile image path from the database or wherever it is stored
    $user = User::findOrFail($userId);
    $imagePath = $user->profile_image;

    // Delete the image from the server
    if ($imagePath) {
        // Construct the full image path
        $fullImagePath = public_path('admin_assets/img/') . $imagePath;

        // Check if the image file exists
        if (file_exists($fullImagePath)) {
            // Delete the image file
            unlink($fullImagePath);

            // Update the user's profile image path to null or any default value if necessary
            $user->profile_image = null;
            $user->save();

            return response()->json(['success' => true]);
        }
    }

    return response()->json(['success' => false]);
}

public function setAvatar(Request $request)
{
    $user = auth()->user()->name(); // Retrieve the authenticated user
    $avatarUrl = $request->input('avatarUrl'); // Get the avatar URL from the request

    // Update the user's avatar URL
    $user->avatar = $avatarUrl;
    $user->save();

    return response()->json(['success' => true]);
}
}
