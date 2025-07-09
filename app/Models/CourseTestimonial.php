<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseTestimonial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'occupation',
        'message',
        'rating',
        'photo',
        'course_id',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
