<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin\Search;
class CreateQuestionsMiddleware
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
        $search = Search::findOrFail($request->route('id'));
        if($search)
        {
            if($search->status == 0)
            {

        return $next($request);
            }
        }

        return redirect()->back();
    }
}
