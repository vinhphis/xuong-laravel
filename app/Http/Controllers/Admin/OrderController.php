<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    const PATH_URL = 'admin.orders.';

    public function list()
    {
        $allOrderUser = Orders::query()
            ->latest('created_at')
            ->get();
        return view(self::PATH_URL . __FUNCTION__, compact('allOrderUser'));
    }

    public function detail($id)
    {
        $detailOrderUser = Orders::query()
            ->with(['user', 'voucher'])
            ->where('id', $id)
            ->first();

        return view(self::PATH_URL . __FUNCTION__, compact('detailOrderUser'));
    }

    public function invoice($id)
    {
        $detailOrderUser = Orders::query()
            ->with(['user', 'voucher'])
            ->where('id', $id)
            ->first();

        return view(self::PATH_URL . __FUNCTION__, compact('detailOrderUser'));
    }

    public function updateStatusOrder(Request $request)
    {
//        dd(\request()->all());
        Orders::query()->where('id', $request->order_id)->update([
            'status_order' => $request->status_order
        ]);
        return back();
    }

    public function updateStatusPayment(Request $request)
    {
//        dd(\request()->all());
        Orders::query()
            ->where('id', $request->order_id)
            ->update([
                'status_payment' => $request->status_payment
            ]);
        return back();
    }

    public function destroy(Orders $orders)
    {
        $check = $orders->update([
            'status_order' => Orders::STATUS_ORDER_CANCELED
        ]);
//        dd($check);
        return back()->with('msg', 'Hủy đơn hàng thành công');
    }
}
