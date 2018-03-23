<?php

namespace ClinicalSkillOnline\Model;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $fillable = [
        'usergroup_id',
        'org_id',
        'users_id',
        'profile_firstname',
        'profile_lastname',
        'profile_phonenumber',
        'profile_paypalclient_id',
        'profile_paypalclientsecret',

    ];
    protected $table = 'profile';

    protected $primaryKey = 'profile_id';
    protected $hidden = [
        'profile_paypalclientsecret'];

    public function usergroup()
    {
        return $this->belongsTo('ClinicalSkillOnline\Model\Usergroup','usergroup_id','usergroup_id');
    }
    public function user()
    {
        return $this->belongsTo('ClinicalSkillOnline\User','users_id','id');
    }
    public function organization()
    {
        return $this->belongsTo('ClinicalSkillOnline\Model\Organization','org_id','org_id');
    }
}
