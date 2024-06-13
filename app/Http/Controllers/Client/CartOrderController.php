<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CartOrderController extends Controller
{
    const PATH_URL = 'client.cart_order.';

    public function showCart()
    {
        $cartUser = Carts::query()
            ->where('user_id', Auth::id())
            ->with('productVariant')
            ->get();
//        dd($cartUser->productVariant);
        return view(self::PATH_URL . 'cart', compact('cartUser'));
    }

    public function cart(Request $request)
    {
//        $request->validate([
//            'product_id' => ['required'],
//            'product_color' => ['required'],
//            'product_size' => ['required'],
//            'quantity' => ['required'],
//        ]);
        $data = $request->all();
        $checkVariant = ProductVariant::query()
            ->where('product_id', $data['product_id'])
            ->where('product_color_id', $data['product_color'])
            ->where('product_size_id', $data['product_size'])
            ->where('is_active', true)
            ->first();
//        dd($checkVariant->quantity);
        if (!$checkVariant) {
            return back()->with([
                'msg' => 'Biến Thể Không Tồn Tại',
                'status' => 'danger'
            ]);
        } else if ($checkVariant->quantity == 0) {
            return back()->with([
                'msg' => 'Số lượng sản phẩm bằng 0',
                'status' => 'danger'
            ]);
        } else {
            $data['product_variant_id'] = $checkVariant->id;
            $data['user_id'] = Auth::id();
            $checkVariantCart = Carts::query()
                ->where('product_variant_id', $checkVariant->id)
                ->get();
//            dd($checkVariantCart);
            if ($checkVariantCart) {
                Carts::query()
                    ->where('product_variant_id', $checkVariant->id)
                    ->delete();
            }
            Carts::query()->create($data);

            return back()->with([
                'msg' => 'Đã thêm sản phẩm ' . $checkVariant->product->name . ' vào giỏ hàng!',
                'status' => 'success'
            ]);
        }
    }

    public function deleteCart($id)
    {
        Carts::query()
            ->where('id', $id)
            ->delete();
        return back()->with([
            'msg' => 'Xóa sản phẩm thành công!',
            'status' => 'success'
        ]);
    }


    public function showPayment()
    {
        $carts = Carts::query()
            ->whereIn('id', Cache::get('addToCart'))
            ->get();

        $userDetail = User::query()
            ->where('id', Auth::id())
            ->get()
            ->first();
        return view(self::PATH_URL . 'payment', compact('carts', 'userDetail'));
    }

    public function payment(Request $request)
    {
        if (isset($request->addToCart) && empty($request->addToCart)) {
            return back()->with([
                'msg' => 'Vui lòng chọn sản phẩm trước khi thanh toán',
                'status' => 'danger'
            ]);
        }

        if (empty($request->addToCart)) {
            Cache::put('addToCart', Cache::get('addToCart'), now()->addMinutes(60));
        } else {
            Cache::put('addToCart', $request->addToCart, now()->addMinutes(60));
        }
        $carts = Carts::query()
            ->whereIn('id', Cache::get('addToCart'))
            ->get();

        $userDetail = User::query()
            ->where('id', Auth::id())
            ->get()
            ->first();


        // apply voucher
        if ($request->applyVoucher) {
            $checkVoucher = Voucher::query()->where('id', $request->voucher)->first();
            if ($checkVoucher->type === Voucher::TYPE_FIXED) {
                if ($request->total_applyVoucher < $checkVoucher->min_price) {
                    return back()->with([
                        'msg' => 'Số tiền không đủ để sử dụng mã này',
                        'status' => 'danger'
                    ]);
                } else {
                    $totalPriceAfter = $request->total_applyVoucher - $checkVoucher->discount;
                    $totalPrice = $totalPriceAfter > $checkVoucher->total ? $totalPriceAfter : $checkVoucher->total;
                    return back()->with([
                        'totalPrice' => $totalPrice,
                        'voucher' => $request->voucher,
                        'discount' => $checkVoucher->total,
                    ]);
                }
            } else if ($checkVoucher->type === Voucher::TYPE_PERCENTAGE) {
                if ($request->total_applyVoucher < $checkVoucher->min_price) {
                    return back()->with([
                        'msg' => 'Số tiền không đủ để sử dụng mã này',
                        'status' => 'danger'
                    ]);
                } else {
                    $discoutVoucher = $request->total_applyVoucher * $checkVoucher->discount / 100;
                    $totalPriceAfter = $request->total_applyVoucher - $discoutVoucher;
                    $totalPrice = $discoutVoucher < $checkVoucher->total ? $totalPriceAfter : $request->total_applyVoucher - $checkVoucher->total;
                    return back()->with([
                        'totalPrice' => $totalPrice,
                        'voucher' => $request->voucher,
                        'discount' => $discoutVoucher < $checkVoucher->total ? $discoutVoucher : $checkVoucher->total,
                    ]);
                }
            }
        }

        if ($request->paymentSuccess) {
            $request->validate(
                [
                    'user_name' => ['required'],
                    'user_phone' => ['required'],
                    'user_email' => ['required'],
                    'user_address' => ['required'],
                ],
                [],
                [
                    'user_name' => 'họ Tên',
                    'user_phone' => 'số điện thoại',
                    'user_email' => 'email',
                    'user_address' => 'địa chỉ',
                ]
            );
            DB::beginTransaction();
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $data['voucher_id'] = $request->voucher ? $request->voucher : null;
//            dd($data['total_price']);
            // tạo dữ liệu bảng order
            $order_id = Orders::query()->create($data);
            $checkProduct = Carts::query()->whereIn('id', $request->cart_id)->get();
            foreach ($checkProduct as $order) {
                // tạo dư liệu bảng orderItem
                OrderItem::query()->create([
                    'orders_id' => $order_id->id,
                    'product_variant_id' => $order->productVariant->id,
                    'product_variant_price' => $order->productVariant->price,
                    'quantity' => $order->quantity,
                    'product_name' => $order->productVariant->product->name,
                    'product_sku' => $order->productVariant->product->sku,
                    'product_img_thumbnail' => $order->productVariant->product->img_thumbnail,
                    'product_price_regular' => $order->productVariant->product->price_regular,
                    'product_price_sale' => $order->productVariant->product->price_sale,
                    'variant_color_name' => $order->productVariant->product_color->name,
                    'variant_size_name' => $order->productVariant->product_size->name,
                ]);

                // cập nhật lại số lượng sản phẩm của từng biến thể được mua trong đơn hàng
                $updateQuantityVariant = $order->productVariant->quantity - $order->quantity;
                ProductVariant::query()
                    ->where('id', $order->productVariant->id)
                    ->update([
                        'quantity' => $updateQuantityVariant,
                    ]);

                // xóa những sản phẩm trong giỏ hàng đã được mua
                Carts::query()->where('id', $order->id)->delete();
            }

            // kiểm tra có sử dụng voucher không nếu có sẽ xóa voucher ảng trung gian và trừ 1 số lượng
            if ($data['voucher']) {
                $voucherItem = Voucher::query()
                    ->where('id', $data['voucher'])
                    ->first();
                $updateQuantityVoucher = $voucherItem->quantity - 1;

                DB::table('user_voucher')
                    ->where([
                        'user_id' => Auth::id(),
                        'voucher_id' => $data['voucher'],
                    ])
                    ->delete();
                Voucher::query()
                    ->where('id', $data['voucher'])
                    ->update([
                        'quantity' => $updateQuantityVoucher,
                    ]);
            }
//            dd($data);
            DB::commit();
            $detailOrderUser = Orders::query()
                ->with(['user', 'voucher'])
                ->where('id', $order_id->id)
                ->first();
            Mail::send('client.invoice', compact(['detailOrderUser']), function ($email) {
                $email->to('zephy2882004@gmail.com', 'vinh quang');
            });
            if ($data['payment'] === 'online') {
                return redirect()->route('client.vnpay_payment')->with([
                    'totalAmount' => $data['total_price'],
                    'order_id' => $order_id->id,

                ]);
            }
            return redirect()->route('client.home')->with([
                'msg' => 'Bạn đặt hàng thành công, vui lòng kiểm tra đơn hàng!',
                'status' => 'success'
            ]);

        }
        return view(self::PATH_URL . 'payment', compact('carts', 'userDetail'));
    }

    public function order()
    {
        $orderUser = Orders::query()->where('user_id', Auth::id())->latest('id')->get();
        return view(self::PATH_URL . 'order', compact('orderUser'));
    }

    public function orderCanceled(string $id)
    {
        $orders = Orders::query()->findOrFail($id);
        $check = $orders->update([
            'status_order' => Orders::STATUS_ORDER_CANCELED
        ]);
//        dd($check);
        return back()->with([
            'msg' => 'Hủy đơn hàng thành công, vui lòng kiểm tra lại!!',
            'status' => 'success'
        ]);
    }

    public function orderItem(string $id)
    {
        $detailOrderUser = Orders::query()->where('id', $id)->first();
//        dd($detailOrderUser);
        return view('client.users.invoice', compact('detailOrderUser'));
    }

}
