<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Member
 *
 * @const GENDER_MALE
 * @const GENDER_FEMALE
 * @const GENDER_OTHER
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $qq
 * @property string $GitTq
 * @property string $GitHub
 * @property string $stdId
 * @property string $department
 * @property string $grade
 * @property date $birthday
 * @property unsignedInteger $gender
 * @property string $QA
 * @property string $nickname
 * @property string $remark
 *
 * @property-read \App\Models\Team[] $teams
 **/
class Member extends Model
{
    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;
    const GENDER_OTHER = 2;

    protected $guarded = [];
    
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team');
    }
}
