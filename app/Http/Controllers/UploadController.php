<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
class UploadController extends Controller
{
    //
    public function uploadForm()
    {
        $levels = Level::all();
        $categories = Category::all();
        return view('upload', compact('levels', 'categories'));
    }

    public function store(Request $request)
    {

        try {
            $cover = $request->file('cover') ? $request->file('cover')->store('cover', 'public') : null;
            $file = $request->file('file') ? $request->file('file')->store('file', 'public') : null;
        } catch (\Exception $e) {
            // Log the error or return a response to help with debugging
            return response()->json(['error' => 'File storage failed: ' . $e->getMessage()], 500);
        }
        
        $content = new Content();
        $content->subject_topic = $request->input('title');
        $content->content_details = $request->input('description');
        $content->content_indicators = $request->input('indicators');
        $content->grade = $request->input('level');
        $content->category = $request->input('category');
        $content->cover_image = $cover;
        $content->video_pdf = $file;
        $content->e_testing = $request->input('e_testing') === 'on' ? true : false;
        $content->save();

        return response()->json(['message' => 'Content created successfully!', 'data' => $content]);
    }

    public function saveContent(Request $request)
    {
        // Find the content
        $content = Content::findOrFail($request->input('content_id'));

        // Loop through each question
        foreach ($request->input('q') as $key => $questionData) {
            // Handle question image upload
            $questionImagePath = null;
   
            if ($request->hasFile("q.{$key}.question_image")) {
                $questionImagePath = $request->file("q.{$key}.question_image")->store('question_images');
            }
            // Create a new question record
            $question = new Question();
            $question->content_id = $content->id;
            $question->question_text = $questionData['question_message'];
            $question->correct_choice = $questionData['answer'];
            $question->question_score = $questionData['score'];
            $question->question_image = $questionImagePath;
            $question->save();


            // Loop through each option
            foreach ($questionData['options'] as $optionKey => $optionData) {
                // Handle option image upload
                $optionImagePath = null;
                if ($request->hasFile("q.{$key}.options.{$optionKey}.image")) {
                    $optionImagePath = $request->file("q.{$key}.options.{$optionKey}.image")->store('option_images');
                }

                // Create a new option record
                $answer = new Answer();
                $answer->question_id = $question->id;
                $answer->answer_text = $optionData['text'];
                $answer->answer_image = $optionImagePath;
                $answer->save();
            }
        }

        return response()->json(['message' => 'Quiz stored successfully!', 'id' => $content->id], 200);
        
    }
}
