<?php

namespace Appcart\Iroad\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
Use Session;

class InvalidLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
              
        if($role=='admin')
        {
            if (!session()->has('admin_token')) {
                return redirect('admin');
            } 
        }else if($role=='manager')
        {
            if (!session()->has('manager_token')) {
                return redirect('manager');
            }  
        }else if($role=='store')
        {
            if (!session()->has('store_token')) {
                return redirect('store');
            }  
        }else if($role=='purchase')
        {
            if (!session()->has('purchase_token')) {
                return redirect('purchase');
            }  
        }

        $request['role']=$role;
        
        return $next($request);
    }
}
