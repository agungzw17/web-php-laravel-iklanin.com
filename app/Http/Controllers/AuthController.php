<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\UserRegister;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerStore(UserRegister $request) {
        if($request->type == 1) {
            $passwordBcrypt = bcrypt($request->password);
            $passwordBcrypt = Hash::make($passwordBcrypt);
            $passwordBcrypt = bcrypt($request->password);

            User::create([
                'role_name' => $request->roles,
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $passwordBcrypt,
                'birth_date' => $request->birth_date,
                'address' => $request->address,
                'type' => $request->type,
                'no_hp' => $request->no_hp,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter
            ]);
        }

        if($request->type == 2) {
            $passwordBcrypt = bcrypt($request->company_password);
            $passwordBcrypt = Hash::make($passwordBcrypt);
            $passwordBcrypt = bcrypt($request->company_password);

            User::create([
                'role_name' => $request->roles,
                'username' => $request->company_username,
                'name' => $request->company_ceo,
                'company_name' => $request->company_name,
                'email' => $request->company_email,
                'password' => $passwordBcrypt,
                'birth_date' => $request->birth_date,
                'address' => $request->address,
                'type' => $request->type,
                'no_hp' => $request->no_hp,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter
                ]);
        }

        return view('main.login');
    }
}
