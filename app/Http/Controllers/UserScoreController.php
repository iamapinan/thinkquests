<?php

namespace App\Http\Controllers;

use App\Models\UserScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\User; // Import the User model

class UserScoreController extends Controller
{
    /**
     * Display a listing of the user scores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userScores = UserScore::with(['user', 'content'])->paginate(10);
        
        return view('score.index', compact('userScores'));
    }

    /**
     * Export the user scores to a CSV file.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportCSV()
    {
        $fileName = 'user_scores.csv';
        $userScores = UserScore::with(['user', 'content'])->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['ID', 'User ID', 'Content ID', 'Score', 'Timestamp'];

        $callback = function() use($userScores, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($userScores as $userScore) {
                $row = [
                    $userScore->id,
                    $userScore->user->name,  // Assuming user has a 'name' attribute
                    $userScore->content->title,  // Assuming content has a 'title' attribute
                    $userScore->score,
                    $userScore->timestamp,
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
    /**
     * Display the specified user's scores.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $userScores = UserScore::with(['content'])->where('user_id', $user->id)->paginate(10); // Paginate with 10 per page
        return view('score.user', compact('user', 'userScores'));
    }

    /**
     * Export the specified user's scores to a CSV file.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function exportUserCSV(User $user)
    {
        $fileName = $user->name . '_scores.csv';
        $userScores = UserScore::with(['content'])->where('user_id', $user->id)->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['ID', 'Content ID', 'Score', 'Timestamp'];

        $callback = function() use($userScores, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($userScores as $userScore) {
                $row = [
                    $userScore->id,
                    $userScore->content->subject_topic,  // Assuming content has a 'subject_topic' attribute
                    $userScore->score,
                    $userScore->timestamp,
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}