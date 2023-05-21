<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'expert_id',
        'title',
        'description',
    ];

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}
