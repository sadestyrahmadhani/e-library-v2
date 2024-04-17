<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Users',
            'users' => User::all(),
        ];

        return view('user.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Users',
            'action' => route('admin.users.store'),
        ];

        return view('user.form', $data);
    }

    public function store(UserRequest $request)
    {
        try {
            $request->merge(['password' => Hash::make($request->password)]);
            User::create($request->only('name', 'email', 'username', 'password', 'role'));

            return redirect()->route('admin.users')->with('success', 'Berhasil menambahkan users');
        } catch(Exception $e){
            return redirect()->back()->withErrors(['errors' => 'Opps! terjadi kesalahan']);
        }
    }

    public function Edit(User $user)
    {
        $data = [
            'title' => 'Edit Users',
            'action' => route('admin.users.update', $user->id),
            'data' => $user,
        ];

        return view('user.form', $data);
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $user->update($request->only(['name', 'username', 'email', 'role']));

            return redirect()->route('admin.users')->with('success', 'Berhasil mengubah data users');
        } catch(Exception $e){
            return redirect()->back()->withErrors(['errors' => 'Opps! terjadi kesalahan']);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

            return redirect()->route('admin.users')->with('success', 'Berhasil menghapus users');
        } catch(Exception $e){
            return redirect()->back()->withErrors(['errors' => 'Opps! terjadi kesalahan']);
        }
    }

}
