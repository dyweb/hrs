<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnrollController extends Controller
{
    /**
     * Show the form for enrollment
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enroll.enroll');
    }

    /**
     * Almost same with MemberController,
     * except that MemberController is an api.
     * 
     * TODO: 
     * 
     * Logic here is same as which in MemberController, 
     * so is the html in `MemberForm.vue` and `enroll.blade.php`
     * The reason that I have to violate DRY is that
     * pages using this controller is constructed by Blade through a html form
     * and MemberController is by Vue through ajax
     * and I cannot share the template between these two pages
     * One can solve this by construct a auth system with Vue from scratch.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MemberController::validator($request->all())->validate();
        MemberController::saveMember(new Member, $request->all());

        return view('enroll.success');
    }
}
