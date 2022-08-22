<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use App\Traits\SesionInfoTrait;

class AuthCompany extends Middleware
{
    use SesionInfoTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$guards)
    {
        //dd( $this->authenticate($request, ['employee']));
        //$this->authenticate($request, ['employee']);  
        //dd($this,$request->expectsJson());
        $actionBlock = [
            "App\Http\Controllers\EmployeeController@index",
            "App\Http\Controllers\UserController@index"
        ];
        $NameRedirect = 'login_staff';
        $action =  $request->route()->getActionName();
        $continue = true;
        if($this->islogged()){                        
            if($request->method() == "GET" ){
                if(!$this->isUserADM()){
                    if(in_array($action,$actionBlock)){
                        $NameRedirect = 'home_staff';
                        $continue = false;
                    }                    
                }
            }
            //dd($continue);
            if($continue){
                return $next($request);
            }
        }        
        return redirect()->route($NameRedirect);
    }
    
    


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //dd($request->expectsJson());
        if (!$request->expectsJson()) {
            //dd($request,route('login_staff'));
            return redirect()->route('login_staff');
        }
    }
}
