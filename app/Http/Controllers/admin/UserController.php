<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
       $users = User::all();
       return view('users.create', compact('users'));
    }

    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required'
         ]);

         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
         ]);

         return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
       $user = User::findOrFail($id);
        return view('users.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
       $request->validate([
            'name' => 'required',
            'email' => 'requited|email|unique:users,email' . $id,
            'role' => 'required',
       ]);

       $data = $request->only(['name', 'email', 'role']);

       if ($request->password) {
            $data['password'] = Hash::make($request->password);
       }

       $user->update($data);
       return redirect()->route('users.index')->with('success', 'User berhasil diupdate');


    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
