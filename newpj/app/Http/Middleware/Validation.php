<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Validation
{

    public function handle(Request $request, Closure $next): Response
    {
        $req=$request->getRequestUri();

        if (str_contains($req,'register')||str_contains($req,'login'))
            return $next($request);
        else
        if (str_contains($req,'post'))
        {
            if (str_contains($req,'home'))
                return $next($request);
            if (str_contains($req,'create')&&$request->get('uid')!==null)
                return $next($request);
            if (str_contains($req,'update')) {
                $post=Post::query()->find($request->id)->get();
                if ($post->uid===$request->uid)
                return $next($request);
            }
            else return \response()->json(['message'=>"You are not allow to update this post",'status'=>'401']);
        }

        return \response()->json(['message'=>"U must login first",'status'=>'401']);
    }
}
