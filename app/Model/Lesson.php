<?php

namespace ClinicalSkillOnline\Model;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'order',
        'course_id',
        'lesson_title',
        'lesson_description',
        'lesson_image',
        'lesson_video'
    ];
    protected $table = 'lesson';

    protected $primaryKey = 'lesson_id';

    public function course()
    {
        return $this->belongsTo('ClinicalSkillOnline\Model\Course','course_id','course_id');
    }
}
