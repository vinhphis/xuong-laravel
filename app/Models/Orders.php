<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    const STATUS_ORDER = [
        [
            'value' => 'Chờ xác nhận',
            'key' => 'pending',
            'index' => 1
        ],
        [
            'value' => 'Đã xác nhận',
            'key' => 'confirmed',
            'index' => 2
        ],
        [
            'value' => 'Đang chuẩn bị hàng',
            'key' => 'preparing_goods',
            'index' => 3
        ],
        [
            'value' => 'Đang vận chuyển',
            'key' => 'shipping',
            'index' => 4
        ],
        [
            'value' => 'Đã giao hàng',
            'key' => 'delivered',
            'index' => 5
        ],
        [
            'value' => 'Đơn hàng đã bị hủy',
            'key' => 'canceled',
            'index' => 6
        ],


    ];
    const STATUS_PAYMENT = [
        [
            'key' => 'unpaid',
            'value' => 'Chưa thanh toán',
            'index' => 1
        ],
        [
            'key' => 'paid',
            'value' => 'Đã thanh toán',
            'index' => 2
        ],
    ];

    const STATUS_ORDER_PENDING = 'pending';
    const STATUS_ORDER_CONFIRMED = 'confirmed';
    const STATUS_ORDER_PREPARING_GOODS = 'preparing_goods';

    const STATUS_ORDER_SHIPPING = 'shipping';
    const STATUS_ORDER_DELIVERED = 'delivered';
    const STATUS_ORDER_CANCELED = 'canceled';

    const STATUS_PAYMENT_UNPAID = 'unpaid';
    const STATUS_PAYMENT_PAID = 'paid';

    protected $fillable = [
        'user_id',
        'voucher_id',
        'user_name',
        'user_email',
        'user_phone',
        'user_address',
        'user_note',
        'payment',
        'total_price',
        'status_order',
        'status_payment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

}
