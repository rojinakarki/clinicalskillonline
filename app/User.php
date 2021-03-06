<?php

namespace ClinicalSkillOnline;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;



    protected $fillable = [
        'name', 'email', 'password','role'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $primaryKey = 'id';


    public function profile()
    {
        return $this->hasOne('ClinicalSkillOnline\Model\Profile','user_id','id');
    }
}
