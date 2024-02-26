<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class EmpController extends \Illuminate\Routing\Controller
{
    public function index(Request $request):JsonResponse{
        $post= Post::query()->find($request->get('id'));
        $post->setAttribute('name',$request->get('name'));
        $post->setAttribute('content',$request->get('content'));
        return response()->json(['message' => 'Post updated successfully']);
    }
    public function getList(Request $request,int $uid):JsonResponse{
        $post= Post::query()->where('uid',$uid)->get();

        return response()->json(['data' => $post]);
    }
    public function createPost(Request $request):JsonResponse{
        Post::query()->create(
            ['name'=>$request->input('name')
            ,'uid'=>$request->input('uid'),
            'content'=>$request->input('content')
            ]);
        return response()->json(['message' => 'Post created successfully']);
    }

    public function register(Request $request):JsonResponse{

        // data validation

        // User Model
        User::query()->create([
            "name" => $request->input('name'),
        ]);

        // Response
        return response()->json([
            "status" => true,
            "message" => "User registered successfully"
        ]);
    }

    // User Login (POST, formdata)
    public function login(Request $request):JsonResponse{
        // data validation

        if (User::query()->where('name','=',$request->name)->get())
        return response()->json([
            "status" => 200,
            "data" => User::query()->where('name','=',$request->name)->get()
        ]);
        return response()->json([
            "status" => 400,
            "message" => "User not found"
        ]);
    }

    // User Profile (GET)
    public function profile():JsonResponse{

        $userdata = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userdata
        ]);
    }

    // To generate refresh token value
    public function refreshToken(){

        $newToken = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "New access token",
            "token" => $newToken
        ]);
    }

    // User Logout (GET)
    public function logout(){

        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "User logged out successfully"
        ]);
    }
}
