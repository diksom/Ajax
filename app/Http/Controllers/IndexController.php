<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return UserResource::collection($users);
    }
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
        ]);
        return new UserResource($user);
    }
    public function delete($id)
    {
        User::destroy($id);
        return 'Success';
    }
    public function changeName(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->name
        ]);
        return new UserResource($user);
    }
}
