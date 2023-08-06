<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required|unique:users',
            'password' => 'required|unique:users',

        ], [
            'email.required' => 'không được để trống ',
            'email.unique' => 'Project đã tồn tại',
            'name.required' => 'Khong de trong',
            'password' => 'khong de trong',
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => User::ROLE_USER,
        ]);
        return redirect(route('login'))->with('message', 'Dang ky tai khoan thanh cong');
    }
}
