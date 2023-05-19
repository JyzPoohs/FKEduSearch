<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'description',
        'ref_complaint_type_id',
        'ref_complaint_status_id',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'complaint_created_at' => 'datetime',
    ];

    public function type()
    {
        return $this->belongsTo(Reference::class, 'ref_complaint_type_id');
    }
}
