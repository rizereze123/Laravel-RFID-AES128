<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\UserCard;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/dashboard/userinfo/index', [
            'userinfos' => UserInfo::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/dashboard/userinfo/create', [
            'userCards' => UserCard::where('card_status', '!=', true)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'unique_identity' => 'required',
            'DOB' => 'required',
            'user_card_uid' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'role' => 'required',
            'address' => 'required',
        ]);

        $userInfo = UserInfo::create($validatedData);

        if ($userInfo->user_card_uid != null) {
            UserCard::where('uid', $userInfo->user_card_uid)->update(['card_status' => true]);
        }
        if (!$userInfo) {
            return 'Create user information failed';
        }

        return redirect('/dashboard/user-info');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Http\Response
     */
    public function show(UserInfo $userInfo)
    {
        return view('/dashboard/userinfo/show', [
            'userInfo' => $userInfo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(UserInfo $userInfo)
    {
        return view('/dashboard/userinfo/edit', [
            'userInfo' => $userInfo,
            'userCards' => UserCard::first('card_status', '=', 1)->get(),
            // 'userCards' => UserCard::first('uid', $userInfo->user_card_uid)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserInfo $userInfo)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'unique_identity' => 'required',
            'DOB' => 'required',
            'user_card_uid' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'role' => 'required',
            'address' => 'required',
        ]);

        // Perbarui data pada instance $userInfo
        $userInfo->update($validatedData);

        if ($userInfo->user_card_uid != null) {
            UserCard::where('uid', $userInfo->user_card_uid)->update(['card_status' => true]);
        }
        if (!$userInfo) {
            return 'Create user information failed';
        }

        return redirect('/dashboard/user-info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserInfo $userInfo)
    {

        // $userInfo->delete();
        // Simpan uid untuk digunakan dalam operasi update
        $uid = $userInfo->user_card_uid;

        // Hapus userInfo
        $userInfo->delete();

        // Update card_status pada user_cards berdasarkan uid
        UserCard::where('uid', $uid)->update(['card_status' => false]);

        return redirect('/dashboard/user-info');
    }

    public function anyIndex()
    {
        return view('/dashboard/userinfo/index', [
            'userinfos' => UserInfo::all(),
        ]);
    }

    public function anyShow(UserInfo $userInfo)
    {
        if ($userInfo->status) {
            UserCard::where('uid', $userInfo->user_card_uid)->update(['card_status' => false]);
        }

        return view('/dashboard/userinfo/show', [
            'userInfo' => $userInfo
        ]);
    }
}
