<?php


namespace App\Http\Middleware;
use Closure;


class CustomAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $value = $request->session()->get('authentication_bareer');

        if ($value) {
            return $next($request);
        }
        else {
            return redirect('/');
        }

//        return $next($request);
//        if ($request->type != 2) {
//            return response()->json('Please enter valid type');
//        }
//
//
//        return $next($request);
    }
}