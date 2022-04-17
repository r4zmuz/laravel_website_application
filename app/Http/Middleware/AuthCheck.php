<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('LoggedUser') && ($request ->path() !='auth/login' && $request->path()!='auth/register')){ //kui ei ole logitud kasutaja ja teekond ei ole login voi register
            return redirect('auth/login')->with('fail', 'Jätkamiseks logige sisse'); //siis suuname tagasi login lehele koos teavitusega
        }

        if(session()->has('LoggedUser') && ($request->path() =='auth/login' || $request->path() == 'auth/register')) { // kui sessioonis on sisse logitud kasutaja ja requested tee on login voi register
            return back(); // siis suuname tagasi eelmisele lehele
        }
        return $next($request)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate') // header funktsioonid keelavad ara tagasi minemise eelmisele lehele kui oled valja logitud
                                ->header('Pragma', 'no-cache')
                                ->header('Expires', 'Sat 01 Jan 1990 00:00:00 GMT'); 
    }
}
