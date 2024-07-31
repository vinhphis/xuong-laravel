<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Orders::class)->constrained();
            $table->foreignIdFor(\App\Models\ProductVariant::class)->constrained();

            $table->unsignedBigInteger('quantity')->default(1);

            // lưu thông tin sản phẩm
            $table->string('product_name');
            $table->string('product_sku');
            $table->string('product_img_thumbnail');
            $table->double('product_price_regular');
            $table->double('product_price_sale');

            // lưu thông tin biến thể
            $table->string('variant_color_name');
            $table->string('variant_size_name');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
