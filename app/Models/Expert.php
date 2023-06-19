<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ref_category_id',
        'cv_upload',
        'ref_expert_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Reference::class, 'ref_category_id');
    }

    public function expertStatus()
    {
        return $this->belongsTo(Reference::class, 'ref_expert_status');
    }

    public function answeredPosts()
    {
        return $this->hasMany(Post::class, 'accepted_by', 'user_id');
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
}
