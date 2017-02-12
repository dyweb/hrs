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
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Team[] $teams
 **/
class Member extends Model
{
    protected $guarded = [];
    
    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;
    const GENDER_OTHER = 2;
    const GENDER_CONSTS = [
        'Male' => 0,
        'Female' => 1,
        'Others' => 2
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'email', 'email');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Models\Team');
    }

    /**
     *  Whether this Member has not account
     * i.e. has no 'User' instance related
     *
     * @return boolean
     */
    public function isPending()
    {
        return is_null($this->user);
    }

    /**
     * Assign an account to `Member`
     * which means a `User` instance with randomized password
     * will be construted for it.
     *
     * If the 'Member' already has a 'User' associated, 
     * nothing will happed.
     *
     * The `User` instance associated will be returned.
     *
     * @return \App\Models\User
     */
    public function setAccount()
    {   
        $user = !$this->isPending() ? $this->user : 
            $this->user()->create([
                'email' => $this->email,
                'password' => bcrypt(str_random(6))
                // TODO: randomly generated password ?
            ]);
        return $user;
    }
}
