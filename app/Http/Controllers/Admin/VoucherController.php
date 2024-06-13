<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Models\Voucher;

class VoucherController extends Controller
{
    const PATH_URL = 'admin.vouchers.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $restoreVoucher = Voucher::withTrashed()->findOrFail(2);
//        $restoreVoucher->restore();

        $dataVoucher = Voucher::query()->get();
        return view(self::PATH_URL . __FUNCTION__, compact('dataVoucher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoucherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher)
    {
        return view(self::PATH_URL . __FUNCTION__, compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        $dataVoucher = $request->all();
        $dataVoucher['is_active'] ??= 0;
        $voucher->update($dataVoucher);
        return redirect()->route('admin.vouchers.index')->with('msg', 'Cập nhật mã giảm giá thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        $voucher->update([
            'is_active' => false
        ]);

        return back()
            ->with('msg', 'Xóa mã giảm giá thành công');
    }
}
