<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the activity logs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activityLogs = ActivityLog::with('user')->paginate(10);
        return view('activity_logs.index', compact('activityLogs'));
    }

    /**
     * Display the specified user's activity logs.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $activityLogs = ActivityLog::where('user_id', $user->id)->paginate(10);
        return view('activity_logs.show', compact('user', 'activityLogs'));
    }
}