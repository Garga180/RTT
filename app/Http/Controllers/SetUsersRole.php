<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SetUsersRole extends Controller
{
    public function ListUsers()
    {
        $users = User::select('id', 'name', 'email', 'role')->get();
        return view('profile.partials.set-user-role', compact('users'));
    }

    public function UpdateRole(Request $request)
    {


        if ($request->has('roles')) {
            foreach ($request->input('roles') as $userId => $role) {
                // Ellenőrizzük, hogy az adott user létezik-e
                $user = User::find($userId);
                if ($user) {
                    $user->role = $role;
                    $user->save(); // Módosítások mentése
                }
            }
        }
        return redirect()->back()->with('success', 'Role updated successfully.');
    }
}
