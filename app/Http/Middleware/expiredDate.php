<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class expiredDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {      $today = Carbon::today();
        $exacttoday = strtotime($today);

        $data = File ::join('users','users.id','=','blogs.addedBy')->select('blogs.*','users.name as username')->where('addedBy',auth()->user()->id)->get();

            foreach ($data as $Raw )

        $end_date = strtotime($Raw->end_date);
            if ($end_date >= $exacttoday )
            {
            return $next($request);

    }    else{
            return redirect(url('/Blog'));
            $_SESSION['error'] ="can not edit or delete article expired date ";
        }

    }
}
