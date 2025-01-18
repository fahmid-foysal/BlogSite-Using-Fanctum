<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['user']=User::all();
        return response()->json([
            'status' => true,
            'message' => 'All user data',
            'data' => $data
        ],200);
        //
    }

 
    public function show(string $email)
    {
        $user = User::select('name', 'email')
                    ->where('email', $email)
                    ->first();
    
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404);
        }
    
        return response()->json([
            'status' => true,
            'message' => 'User details',
            'data' => $user,
        ], 200);
    }
    


}
