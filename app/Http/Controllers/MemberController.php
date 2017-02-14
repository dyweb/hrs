<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Member;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show', 'create']);
    }

    /**
     * Get a validator for a request of creating a `App\Models\Member`.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:members',
            'nickname' => 'required',
            'phone' => 'required|numeric',
            'qq' => 'required|numeric',
            'birthday' => 'required|date',
            'stdId' => 'required|alpha_num',
            'department' => 'required',
            'grade' => 'required|alpha_num',
            'gender' => 'required|integer',
            'GitTq' => 'required',
            'GitHub' => 'required',
            'QA' => 'required',
            'remark' => 'required',
            'teams' => 'sometimes|array',
        ]);
        // TODO: some should be given a default value?
    }


    /**
     * Edit the given Member instance according to the given data.
     * The necessity of this function comes from the
     * many-to-many relationship between `Member` and `Team`
     *
     * Data given by frontend will contain a extra 'teams' fields
     * which makes '$member->fill($request->all())' failed 
     * and need extra codes to process.
     *
     * This is function need to be static because `EnrollController` also utilize it
     * @param  \App\Models\Member  $member
     * @return array $data
     */
    public static function saveMember(Member $member, array $data)
    {
        if (isset($data['teams'])) { 
            $teams = $data['teams'];
            unset($data['teams']);
        } else {
            $teams = [];
        }

        // TODO: transaction
        foreach ($teams as $team) {
            $member->teams()->attach($team->id);    
        }

        $member->fill($data);
        $member->save();

        return $member;
    }

    /**
     * Display a listing of member.
     * Members not approved (i.e. has no user accout related) not included
     * 
     * @return json in the format of 
     * {
     *   {
     *      'id' : xxxx
     *       .... all attribute of Member class ...
     *      'teams' : {
     *          'id' : xxxxx
     *          .... all attribute of Teams ....
     *       }
     *   }
     * }
     *
     */
    public function index()
    {
        // TODO: returns too much?
        $members = Member::has('user')->with('teams')->get();
        return $members->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * Besides properties defined in database schema,
     * an array of teams id can be include in the request
     * to denote which teams this member shoulde be added to.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: add etag check
        $this->validator($request->all())->validate();

        $this->saveMember(new Member, $request->all());

        return response('Succeeded', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // TODO: add etag check
        $this->saveMember(Member::findOrFail($id), $request->all());

        return response('Succeeded', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Member::destroy($id);
        return response('Succeed', 200);
    }
}
