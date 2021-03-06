<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin\Search;
use App\User;
class SearchMiddleware
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
        $user = \Auth::user();

           $search =  $user->searches()->where('search_id',$request->route('id'))
           ->where('search_status',0)->get();

        if(count($search) > 0 && ($search[0]['status'] == 1))
        {

            return $next($request);
        }

        return redirect()->back();
    }
}
