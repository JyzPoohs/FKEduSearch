<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'ref_category_id',
        'title',
        'description',
        'accepted_by',
        'answer',
        'ref_post_status_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Reference::class, 'ref_category_id');
    }

    public function expert()
    {
        return $this->belongsTo(User::class, 'accepted_by');
    }

    public function status()
    {
        return $this->belongsTo(Reference::class, 'ref_post_status_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
