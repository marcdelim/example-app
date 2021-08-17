<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
   public function index(Request $request){
    
        $email = $request->input('email');
        $password =  Hash::make($request->input('password'));
        $user = DB::table('users')
                ->where('email', $email)
                ->first();

        if($user){
            return response()->json([
                'message' => "Email already taken",
            ], 400);
        }else{
            DB::table('users')->insert([
                'email' => $email,
                'password' => $password,
                'remember_token' => "default",
                'created_at' => date('Y-m-d h:i:s')
            ]);

            return response()->json([
                'message' => "User successfully registered",
            ], 201);
        }
        
   }

   public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $user = DB::table('users')
            ->where('email', $email)
            ->first();

        if($user){
            if (Hash::check($password, $user->password)) {
                $random = Str::random(40);
                //$hash_token = Hash::make($random);
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['remember_token' => $random]);

                return response()->json([
                    'access_token' => $random,
                ], 201);
            }else{
                return response()->json([
                    'message' => "Invalid Credentials",
                ], 400);
            }
        }else{
            return response()->json([
                'message' => "Invalid Credentials",
            ], 400);
        }
   }
   
}
