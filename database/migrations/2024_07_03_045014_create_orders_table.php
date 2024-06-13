<?php

use App\Models\Orders;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();

            // lưu thông tin người nhận hàng
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone');
            $table->string('user_address');
            $table->string('user_note');

            $table->string('payment');
            $table->boolean('total_price');

            $table->enum('status_order', [
                Orders::STATUS_ORDER_PENDING,
                Orders::STATUS_ORDER_CONFIRMED,
                Orders::STATUS_ORDER_PREPARING_GOODS,
                Orders::STATUS_ORDER_SHIPPING,
                Orders::STATUS_ORDER_DELIVERED,
                Orders::STATUS_ORDER_CANCELED,
            ])->default(Orders::STATUS_ORDER_PENDING);

            $table->enum('status_payment', [
                Orders::STATUS_PAYMENT_UNPAID,
                Orders::STATUS_PAYMENT_PAID,
            ])->default(Orders::STATUS_PAYMENT_UNPAID);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
