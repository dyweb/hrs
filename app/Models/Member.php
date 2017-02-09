<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Member
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
 * @property-read \App\Team[] $teams
 **/
class Member extends Model
{
    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;
    const GENDER_OTHER = 2;

    public function teams()
    {
        return $this->belongsToMany('App\Team');
    }
}
