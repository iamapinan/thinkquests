<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Level;
use App\Models\Category;
use App\Models\Question;
use App\Models\Answer;

class ContentViewerController extends Controller
{
    public function show($id)
    {
        $content = Content::findOrFail($id);
        $level = Level::find($content->grade);
        $category = Category::find($content->category);
        $question = Question::where('content_id', $content->id)->get();
        $questions = [];
        foreach($question as $q){
            $answer = Answer::where('question_id', $q->id)->get();
            $questions[$q->id] = $q;
            $questions[$q->id]['answer'] = $answer;
        }
        return view('content.view', compact('content', 'level', 'category', 'questions'));
    }

    public function showTab($id, $tab)
    {
        $content = Content::findOrFail($id);
        $level = Level::find($content->grade);
        $category = Category::find($content->category);
        $question = Question::where('content_id', $content->id)->get();
        $questions = [];
        foreach($question as $q){
            $answer = Answer::where('question_id', $q->id)->get();
            $questions[$q->id] = $q;
            $questions[$q->id]['answer'] = $answer;
        }
        return view('content.view', compact('content', 'tab', 'level', 'category', 'questions'));
    }
}