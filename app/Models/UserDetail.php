<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'area_of_research',
        'current_academic_status',
        'linkedin_acc',
        'fb_acc',
        'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
