<?php

namespace App\Http\Middleware;

use Closure;

class admin
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
        if(\Auth::user()->role_id!=1){
            session()->flash('session_message','You dont have permissions for this activity');
            return redirect()->route('admin.index.index');
        }
        
        return $next($request);
    }
}
