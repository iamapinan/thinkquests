<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Content;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    //
    public function uploadForm()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'subject_topic' => 'required|string|max:255',
            'content_details' => 'required|string',
            'content_indicators' => 'required|string',
            'grade' => 'required|integer',
            'category' => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpg,png|max:10240', // Max 10MB
            'video_pdf' => 'nullable|file|mimes:pdf,mp4|max:102400', // Max 100MB
            'e_testing' => 'nullable|boolean',
        ]);

        // Handle file uploads
        $coverImagePath = $request->file('cover_image') ? $request->file('cover_image')->store('cover_images') : null;
        $videoPdfPath = $request->file('video_pdf') ? $request->file('video_pdf')->store('video_pdfs') : null;

        // Create a new content record
        $content = new Content();
        $content->subject_topic = $request->input('subject_topic');
        $content->content_details = $request->input('content_details');
        $content->content_indicators = $request->input('content_indicators');
        $content->grade = $request->input('grade');
        $content->category = $request->input('category');
        $content->cover_image = $coverImagePath;
        $content->video_pdf = $videoPdfPath;
        $content->e_testing = $request->input('e_testing', false);
        $content->save();

        $questions = $data['questions'];

        foreach ($questions as $q) {
            $question = new Question();
            $question->type = $q['type'];
            $question->question_text = $q['question_text'];
            
            if (isset($q['question_image'])) {
                $question->question_image = $q['question_image']->store('question_images', 'public');
            }
            
            $question->save();

            foreach ($q['answers'] as $a) {
                $answer = new Answer();
                $answer->question_id = $question->id;
                $answer->answer_text = $a['answer_text'];
                
                if (isset($a['answer_image'])) {
                    $answer->answer_image = $a['answer_image']->store('answer_images', 'public');
                }
                
                $answer->is_correct = $a['is_correct'];
                $answer->score = $a['score'];
                $answer->save();
            }
        }

        return response()->json(['message' => 'Quiz stored successfully!'], 200);
    }
}
