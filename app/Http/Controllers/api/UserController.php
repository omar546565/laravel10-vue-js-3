<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function indexUsers()
    {
        $users = User::paginate(10);
        return response()->json([
            'message' => 'success get users',
            'users' => $users
        ]);
    }
}
