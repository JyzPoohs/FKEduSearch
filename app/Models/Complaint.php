<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'ref_complaint_type_id',
        'description',
        'ref_complaint_status_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function complaintType()
    {
        return $this->belongsTo(Reference::class, 'ref_complaint_type_id');
    }

    public function complaintStatus()
    {
        return $this->belongsTo(Reference::class, 'ref_complaint_status_id');
    }

}
