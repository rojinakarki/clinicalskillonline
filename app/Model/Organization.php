<?php

namespace ClinicalSkillOnline\Model;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'usergroup_id',
        'org_name'
    ];
    protected $table = 'organization';

    protected $primaryKey = 'org_id';

    public function usergroup()
    {
        return $this->belongsTo('ClinicalSkillOnline\Model\Usergroup','usergroup_id','usergroup_id');
    }
}
