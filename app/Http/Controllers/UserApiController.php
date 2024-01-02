<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function createUser (Request $request)
    {
        $user = new User();
        $user->fill($request->all())->save();
        return $user;
    }

    public function showUser (string $id)
    {
        return User::find($id);
    }

    public function updateUser (Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->only('name'));
        return $user;
    }
    public function deleteUser(string $id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
