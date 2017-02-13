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
        ]);
        // TODO: some should be given a default value?
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: returns too much?
        $members = Member::has('teams')->with('teams')->get();
        return $members->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
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
        $this->validator($request->all())->validate();

        $member = new Member;

        if (isset($request['teamsId'])){ 
            $teamsId = $request['teamsId'];
            unset($request['teamsId']);
        } else {
            $teamsId = [];
        }

        $member->fill($request->all());
        $member->save();
        
        foreach ($teamsId as $tid){
            $member->teams()->attach($tid);    
        }


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
        $member = Member::findOrFail($id);
        return view('show', ['member' => $member]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('edit', ['member' => $member]);
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
        $member = Member::findOrFail($id);
        $member->fill($request->all());
        $member->save();

        return redirect()->route('members.index');
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
        return redirect()->route('members.index');
    }
}
