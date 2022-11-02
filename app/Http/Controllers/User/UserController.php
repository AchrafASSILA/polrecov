<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type', '!=', 4)->where('id', '!=', Auth::user()->id)->get();
        return view('users.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create_user');
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
            'name' => 'required',
            'username' => 'required|string|unique:users',
            'password' => 'required|same:confirm-password',
            'type_user' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'type' => $request->type_user,
            'username' => $request->username,
        ]);
        return redirect()->route('users.index')
            ->with('success', 'User a été Ajouter Avec Succes');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit_user', compact('user'));
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
        if ($request->password) {

            $this->validate($request, [
                'name' => 'required',
                'username' => 'required|string|unique:users,username,' . $id,
                'password' => 'required|same:confirm-password',
                'type_user' => 'required'
            ]);
            User::find($id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'type' => $request->type_user,
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required',
                'username' => 'required|string|unique:users,username,' . $id,
                'type_user' => 'required'
            ]);
            User::find($id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'type' => $request->type_user,
            ]);
        }
        return redirect()->route('users.index')
            ->with('success', 'User a été Modifier Avec Succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User a été Supprimer Avec Succes');
    }
}
