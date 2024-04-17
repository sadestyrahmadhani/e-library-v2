<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Login',
        ];

        return view('auth.index', $data);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        try {
            $user = User::where('username', $request->username);

            if($user->count() > 0){
                if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
                    $user = $user->first();
                    if($user->role == "Member"){
                        return redirect()->route('home');
                    } else {
                        return redirect()->route('admin.dashboard');
                    }

                } else {
                    return redirect()->back()->withErrors(['password' => 'Wrong Password']);
                }
            } else {
                return redirect()->back()->withErrors([
                    'username' => 'Username has not registered'
                ]);
            }
        } catch(Exception $e){
            return redirect()->back()->withErrors(['errors' => 'Opps! terjadi kesalahan']);
        }
    }

    public function register()
    {
        $data = [
            'title' => 'Register'
        ];

        return view('auth.register', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required'
        ]);

        try {
            $member = Member::create($request->only(['name','phone','email','address']));
            $request->merge(['password' => Hash::make($request->password), 'member_id' => $member->id]);
            User::create($request->only(['member_id', 'name', 'phone', 'email', 'username', 'password']))->assignRole('Member');

            return redirect()->route('auth')->withSuccess('Pendaftaran berhasil.');
        } catch(Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Opps! terjadi kesalahan saat menyimpan data']);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

}
