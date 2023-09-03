<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
  public function getPermissionRoleId($roleId)
  {
    $Permissions = Permission::where('role_id', $roleId)->get();

    return response()->json([
        'status' => 200,
        'message' => 'Success',
        'permissions' => $Permissions
    ]);
  }

  public function store(Request $request){
    $request->validate([
        'role_id' => 'required',
        'page_id' => 'required',
    ]);

    $permission = Permission::where('role_id', $request->role_id)
    ->where('page_id', $request->page_id);
    $count = $permission->count();
    if($count>0){
        $permission->update([
            $request->permission => $request->event
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Success',
        ]);
    }

    $permission = Permission::create([
        'role_id' => $request->role_id,
        'page_id' => $request->page_id,
        $request->permission => $request->event
    ]);

    return response()->json([
        'status' => 200,
        'message' => 'Success',
    ]);

  }
}
