<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogActivity
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
        $response = $next($request);

        // Check if user is authenticated
        if (Auth::check()) {
            // Log the activity
            if (Auth::user()->roles('Admin')) {
                return $response;
            }
            $activityLog = new ActivityLog();
            $activityLog->user_id = Auth::id();
            if ($request->path() != $request->url()) {
                $activityLog->activity = '['. $request->method() . '] ' . $request->path();
            }
            $activityLog->save();
        }

        // Delete logs older than 90 days
        ActivityLog::where('created_at', '<=', now()->subDays(90))->delete();

        return $response;
    }
}
        

