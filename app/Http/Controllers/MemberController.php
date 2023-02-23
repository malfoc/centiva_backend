<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::with('team')->get();
        return $this->showAll($members);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        $member = new Member();
        $member->fullname = $request->fullname;
        $member->email = $request->email;
        $member->team_id = $request->team_id;
        $member->save();

        return $this->showOne($member);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $member->load('team');
        return $this->showOne($member);
    }
}
