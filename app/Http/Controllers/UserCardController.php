<?php

namespace App\Http\Controllers;

use App\Models\UserCard;
use Illuminate\Http\Request;

class UserCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/dashboard/usercard/index', [
            'userCards' => UserCard::all(),
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCard  $userCard
     * @return \Illuminate\Http\Response
     */
    public function show(UserCard $userCard)
    {
        return view('/dashboard/usercard/show', [
            'userCard' => $userCard
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCard  $userCard
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCard $userCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCard  $userCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCard $userCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCard  $userCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCard $userCard)
    {

        $userCard->userInfo()->delete();
        $userCard->userLog()->delete();
        $userCard->delete();

        return redirect('/dashboard/user-card');
    }
}
