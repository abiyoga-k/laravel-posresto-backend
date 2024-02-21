<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('admin');
        return view('dashboard.pages.users.index', [
            'users' => User::all(),
            'title' => 'User',
            'route' => '/dashboard/users'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.users.create', [
            'title' => 'User',
            'route' => '/dashboard/users'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,staff,user',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('user-image', 'public');
        }

        // $validatedData['role'] = $request->description;

        User::create($validatedData);

        return redirect('/dashboard/users')->with('success', 'New Post Has Been Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show($username)
    {
        $user = User::where('username', '=', $username)->first();
        return view('dashboard.pages.users.profile', [
            'user' => $user,
            'title' => 'user',
            'route' => '/dashboard/users'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username)
    {
        $user = User::where('username', '=', $username)->first();
        return view('dashboard.pages.users.edit', [
            'user' => $user,
            'title' => 'user',
            'route' => '/dashboard/users'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $username)
    {
        $user = User::where('username', '=', $username)->first();

        $rules = [
            'name' => 'required|max:255',
            'role' => 'required|in:admin,staff,user',
        ];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users';
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'required|unique:users';
        }

        if ($request->password) {
            $rules['password'] = 'min:8';
        }

        $validatedData = $request->validate($rules);
        $imagePath = $user->image;
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::disk('public')->delete($imagePath);
            }
            $validatedData['image'] = $request->file('image')->store('user-image', 'public');
        }

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        User::where('id', $user->id)->update($validatedData);

        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return redirect('/dashboard/users')->with('success', 'User Has Been Updated!');
            } else {
                return redirect('/dashboard/users/' . $username)->with('success', 'User Has Been Updated!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $imagePath = $user->image;
        if ($user->image) {
            Storage::disk('public')->delete($imagePath);
        }
        user::destroy($user->id);

        return redirect('/dashboard/users')->with('success', 'User Has Been Deleted!');
    }
}
