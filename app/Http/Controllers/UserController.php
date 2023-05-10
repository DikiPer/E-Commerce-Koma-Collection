<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        $user->save();
        return redirect('/user')->with('success', 'User has been added');
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg|max:3048',
            ]);

            if ($request->hasFile('avatar')) {
                $currentImage = $user->avatar;
                if ($currentImage != "user.png") {
                    unlink(public_path('/storage/avatar/' . $currentImage));
                }
                $imageName = $request->username . '.' . $request->avatar->getClientOriginalExtension();
                $request->avatar->move(public_path('/storage/avatar'), $imageName);
                $user->avatar = $imageName;
            }
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User successfully deleted.');
    }

    public function profile()
    {
        return view('users.my_profile');
    }

    public function detail_user($id)
    {
        $user = User::find($id);


        return view('customer.detail_user', compact('user'));
    }

    public function edit_user($id)
    {
        $user = User::find($id);

        return view('customer.edit_user', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg|max:3048',
            ]);

            if ($request->hasFile('avatar')) {
                $currentImage = $user->avatar;
                if ($currentImage != "user.png") {
                    unlink(public_path('/storage/avatar/' . $currentImage));
                }
                $imageName = $request->username . '-' . $request->id . '.' . $request->avatar->getClientOriginalExtension();
                $request->avatar->move(public_path('/storage/avatar'), $imageName);
                $user->avatar = $imageName;
            }
        }
        // dd($user);
        $user->save();

        return redirect()->route('detail.profile', ['id' => $user->id])->with('success', 'User has been updated');
    }
}