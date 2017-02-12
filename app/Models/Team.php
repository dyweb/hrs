<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Team
 *
 * @const 0 POSITION_PRESIDENT
 * @const 1 POSITION_LEADER
 * @const 2 POSITION_MEMBER
 * @const 3 POSITION_HR
 *
 * @property integer $id
 * @property string $name
 * @property date $created_at
 * @property date $updated_at
 *
 * @property-read App\Models\Member[] leaders
 * @property-read App\Models\Member[] members
 *
 * @method string getPositionName
 *
 **/
class Team extends Model
{
    const POSITION_PRESIDENT = 0;
    const POSITION_LEADER = 1;
    const POSITION_MEMBER = 2;

    public function getLeadersAttribute()
    {
        return $this->members->where('position', '<=', POSITION_LEADER);
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\Member');
    }

    public function getPositionName($position)
    {
        return ['负责人', '组长', '组员'][$position];
    }   
}
