<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_topic',
        'content_details',
        'content_indicators',
        'score',
        'grade',
        'category',
        'cover_image',
        'video_pdf',
        'e_testing',
    ];
}