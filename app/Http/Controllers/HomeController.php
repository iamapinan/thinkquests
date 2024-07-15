<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    //

    public function index()
    {

        $getContents = Content::select(['contents.*', 'levels.name as level_name', 'categories.name as category_name'])
            ->leftJoin('levels', 'contents.grade', '=', 'levels.id')
            ->leftJoin('categories', 'contents.category', '=', 'categories.id')
            ->get();

        return view('dashboard')
            ->with('contents', $getContents);
    }

    public function destroy($id)
    {
        $post = Content::findOrFail($id);
        $post->delete();

        return response()->json(['success' => 'Post deleted successfully']);
    }
}
