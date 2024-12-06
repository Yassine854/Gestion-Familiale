<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    
    public function index()
{
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à votre profil.');
    }

    return view('dashboard', compact('user'));
}

    
    
    
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'birthday' => 'nullable|date',
            'phone' => 'nullable|string|min:8|max:15',
            'gender' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
    
        $user->save();
    
        return view('dashboard', compact('user'));
    }
    
    
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if (Auth::user()->photo && Storage::exists('public/' . Auth::user()->photo)) {
                Storage::delete('public/' . Auth::user()->photo);
            }
            $photoPath = $request->file('photo')->store('photos', 'public');

            Auth::user()->update(['photo' => $photoPath]);

            return back()->with('success', 'Photo updated successfully!');
        }

        return back()->with('error', 'No photo selected!');
    }
    public function deletePhoto()
    {
    
        if (Auth::user()->photo && Storage::exists('public/' . Auth::user()->photo)) {
            Storage::delete('public/' . Auth::user()->photo);
        }
    
        Auth::user()->photo = null;
        Auth::user()->update();
    
        return back()->with('success', 'Photo supprimée avec succès !');
    }
    
}
