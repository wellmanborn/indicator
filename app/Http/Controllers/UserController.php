<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::all();
        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        User::create([
           'name' => $request->get("name"),
           'password' => bcrypt($request->get("password")),
           'email' => $request->get("email"),
           'role' => $request->get("role"),
        ]);
        return redirect()->route("users")->with("success", "Succssfully Created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view("users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->role = $request->get("role");
        $user->save();
        return redirect()->route("users")->with("success", "Succssfully Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function change_activation(Request $request, User $user)
    {
        $user->active = !$user->active;
        $user->save();
        return redirect()->route("users")->with("success", "Successfully Edited");
    }

    public function edit_password(User $user){
        return view("users.change_password", compact("user"));
    }

    public function update_password(UpdateUserPasswordRequest $request, User $user){
        $id = auth()->id();

        $user->password = Hash::make($request->password);
        $user->save();

        Auth::guard('web')->loginUsingId($id);

        return redirect()->route("users")->with("success", "Successfully Edited");
    }
}
