<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:members',
            'phone' => 'required|numeric',
            'qq' => 'required|numeric',
            'GitTq' => 'required',
            'GitHub' => 'required',
            'stdId' => 'required|alpha_num',
            'department' => 'required',
            'grade' => 'required|alpha_num',
            'birthday' => 'required|date',
            'gender' => 'required|integer',
            'QA' => 'required',
            'nickname' => 'required',
            'remark' => 'required',
        ]);

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
