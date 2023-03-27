<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChangeRole extends Controller
{
     
    public function updateroleuser(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $request ->validate([
            'roleId'=>'required'
        ]);
$user->roleId=$request->roleId;
$user->save();

return response()->json($request->roleId);
    }
}
