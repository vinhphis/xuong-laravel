<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    const PATH_URL = 'client.users.';

    public function detail()
    {
        $user = User::query()->findOrFail(Auth::id())->first();
        return view(self::PATH_URL . __FUNCTION__,compact('user'));
    }

    public function voucher()
    {
        $userVoucher = User::query()->where('id', Auth::id())->get()->first();
        return view(self::PATH_URL . __FUNCTION__, compact('userVoucher'));
    }

    public function addVoucher(Request $request)
    {
        $checkValidate = $request->validate([
            'name' => 'required'
        ],
            [],
            [
                'name' => 'Tên mã giảm giá'
            ]);
        $checkVoucher = Voucher::query()
            ->where('name', $checkValidate['name'])
            ->orWhere('code', $checkValidate['name'])
            ->first();
        $checkIssetVoucher = DB::table('user_voucher')
            ->where('user_id', Auth::id())
            ->where('voucher_id', $checkVoucher->id)
            ->first();
//        dd(empty($checkIssetVoucher));
        if ($checkVoucher && empty($checkIssetVoucher)) {
//            dd($checkIssetVoucher);
            $check = DB::table('user_voucher')->insert([
                'user_id' => Auth::id(),
                'voucher_id' => $checkVoucher->id,
            ]);
        }
        return back()->with('msg', 'Thêm mã giảm giá thành công');
    }

}
