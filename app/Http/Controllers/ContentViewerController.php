<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class ContentViewerController extends Controller
{
    public function show($id)
    {
        $content = Content::findOrFail($id);
        return view('content.view', compact('content'));
    }

    public function showTab($id, $tab)
    {
        $content = Content::findOrFail($id);
        return view('content.view', compact('content', 'tab'));
    }
}