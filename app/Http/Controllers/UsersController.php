<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index() {
    	$users = User::orderBy('role', 'asc')->get();

    	return view('users.index')->with('users', $users);
    }

	public function delete($user) {
    	$user = User::find($user);
    	$user->delete();

    	return redirect()->route('users.index');
    }

    public function set_role(Request $request) {
        $user = User::find($request->input('user_id'));
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('users.index');
    }

    public function set_admin($user) {
    	$user = User::find($user);

    	$user->role = 'Administrator';
    	$user->save();

    	return redirect()->route('users.index');
    }

    public function set_user($user) {
    	$user = User::find($user);

    	$user->role = 'Użytkownik';
    	$user->save();

    	return redirect()->route('users.index');
    }
}
