<?php

namespace App\Http\Middleware;

use Closure;
use App\Ideas_deadline;
class CheckDate
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
        $datenow=date("Y-m-d h:i:sa");

        $expdate=Ideas_deadline::firstOrFail();
        if ($datenow<$expdate["end_date"]) {
            
            return $next($request);
        }
        else{
            return response()->json(['message' => 'Deadline ended', "status"=>2]);
        }
    }
}
