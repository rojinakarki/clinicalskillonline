<?php

namespace ClinicalSkillOnline\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $fillable = [
        'course_title',
        'course_status',
        'course_coverimage',
        'course_alttext',
        'course_price',
        'course_description',
        'course_democourse'
    ];
    protected $table = 'course';
    protected $attributes = [
        'course_democourse' => 0
    ];
    protected $primaryKey = 'course_id';

    public function lesson()
    {
        return $this->hasMany('ClinicalSkillOnline\Model\Lesson','course_id','course_id');
    }

}
