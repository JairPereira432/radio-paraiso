<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = ['user_id','title','slug','excerpt','body','image','status','featured','category'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($news) {
            $news->slug = Str::slug($news->title) . '-' . uniqid();
        });
    }

    public function user()     { return $this->belongsTo(User::class); }
    public function comments() { return $this->hasMany(Comment::class); }

    public function scopePublished($query) { return $query->where('status', 'published'); }
    public function scopeFeatured($query)  { return $query->where('featured', true); }
}