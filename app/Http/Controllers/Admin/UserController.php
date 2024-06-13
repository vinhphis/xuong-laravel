<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const PATH_URL = 'admin.accounts.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allUsers = User::query()->get();
//        dd($allUser);
        return view(self::PATH_URL . __FUNCTION__, compact('allUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_URL . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::query()->findOrFail($id);
        $role = [User::USER_ADMIN, User::USER_STAFF, User::USER_MEMBER];
//        dd($role[0]);
        return view(self::PATH_URL . __FUNCTION__, compact(['user', 'role']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $check = $user->update($request->all());
        return redirect()->route('admin.users.index')
            ->with('msg', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
