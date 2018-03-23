<?php

namespace ClinicalSkillOnline\Model;

use Illuminate\Database\Eloquent\Model;

class Usergroup extends Model
{
    public $fillable = [
        'usergroup_name',
        'usergroup_tag'
    ];
    protected $table = 'usergroup';

    protected $primaryKey = 'usergroup_id';

    public function profile()
    {
        return $this->hasMany('ClinicalSkillOnline\Model\Profile','usergroup_id','usergroup_id');
    }
    public function organization()
    {
        return $this->hasMany('ClinicalSkillOnline\Model\Organization','usergroup_id','usergroup_id');
    }

}
