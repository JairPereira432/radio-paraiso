<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['user_id','title','description','youtube_id','thumbnail','category','featured','views','status'];

    public function user() { return $this->belongsTo(User::class); }

    public function getYoutubeThumbnailAttribute(): string
    {
        return "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg";
    }
}