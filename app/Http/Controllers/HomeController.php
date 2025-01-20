<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

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
        try {
            $post = Content::findOrFail($id);
   
            // ลบไฟล์ที่เกี่ยวข้อง
            if ($post->video_pdf && Storage::exists($post->video_pdf)) {
                Storage::delete($post->video_pdf);
            }
            
            // ลบไฟล์ pdf
            if ($post->plan && Storage::exists($post->plan)) {
                Storage::delete($post->plan);
            }

            // ลบไฟล์รูปภาพถ้ามี
            if ($post->cover_image && Storage::exists($post->cover_image)) {
                Storage::delete($post->cover_image);
            }
            
            $post->delete();

            return response()->json(['success' => 'Post deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting post: ' . $e->getMessage()
            ], 500);
        }
    }
}
