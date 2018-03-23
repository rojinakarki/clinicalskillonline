<?php

namespace ClinicalSkillOnline\Model;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'package_name',
        'package_course',
        'package_price'
    ];
    protected $table = 'package';

    protected $primaryKey = 'package_id';

}
