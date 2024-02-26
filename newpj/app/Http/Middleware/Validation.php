<?php

namespace App\Http\Middleware;

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
        if ($request->input('uid')!==null)
        {
            if (str_contains($req,'create'))
                return $next($request);
            if ((int)$request->input('uid') ===(int) $request->input('user'))
                return $next($request);
            else return \response()->json(['message'=>"You are not allow to update this post",'status'=>'401']);
        }
        else
        return \response()->json(['message'=>"U must login first",'status'=>'401']);
    }
}
