<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\User;

class UserController extends Controller
{
    //Get all users and search users by params
    public function index($artisanId, $text=null){
        $users = DB::table('users')
                        ->leftJoin('artisans','artisans.id', '=', 'users.id_artisan')
                        ->where(function ($query) use ($artisanId) {
                            if($artisanId != -1){
                               $query->where('artisans.id', '=', $artisanId);
                            }
                        })
                        ->where(function ($query) use($text) {
                            if($text != null){
                                $query->where('users.name_user', 'like', '%'. $text .'%')
                                ->orWhere('users.last_name', 'like', '%'. $text .'%')
                                ->orWhere('users.email', 'like', '%'. $text .'%')
                                ->orWhere('users.zip_code', 'like', '%'. $text .'%');
                            }
                        })->select('users.*')->get();

        return response()->json([
            "users" => $users
        ], 200, []);
    }

    //Create user
    public function store(Request $request){
        $user = new User();
        $user->name_user = $request->name_user;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $pass = bcrypt($request->password);
        $user->password = $pass;
        $user->artisan = $request->artisan;
        $user->save();

        return response()->json([
            "message" => "User created",
            "user" => $user
        ], 201, []);
    }

    //Edit user
    public function edit(Request $request, $userId){
        $user = User::findOrFail($userId);
        $user->name_user = $request->name_user;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $pass = bcrypt($request->password);
        $user->password = $pass;
        $user->zip_code = $request->zip_code;
        $user->adress = $request->adress;
        $user->acount_number = $request->acount_number;
        $user->save();

        return response()->json([
            "message" => "user edited",
            "response" => $user
        ], 200, []);
    }

    //Get user by ID
    public function show($userId){
        $user = User::findOrFail($userId);

        return response()->json([
            "user" => $user
        ], 200, []);
    }

    //Login user
    public function login(){
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = User::where("email","=",$credentials["email"])->get();

        return response()->json([
            "user" => $user,
            "token" => $token
        ], 200, []);
    }

    //Logout user
    public function logout(){
       
        auth()->logout();

        return response()->json([
            "user" => $user
        ], 200, []);
    }
}
