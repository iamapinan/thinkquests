<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'read',
        'upload',
        'delete_content',
        'update',
        'list',
        'delete_user',
        'view_activities',
        'view_activities_logs',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}