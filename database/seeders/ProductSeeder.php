<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Voucher::query()->truncate();
//        Schema::disableForeignKeyConstraints();
//

//        ProductVariant::query()->truncate();
//        DB::table('product_tag')->truncate();
//        ProductGallery::query()->truncate();
//        Product::query()->truncate();
//        ProductSize::query()->truncate();
//        ProductColor::query()->truncate();
//        Tag::query()->truncate();
//      Schema::disableForeignKeyConstraints(); dùng câu lệnh này trước khi xóa dữ liệu trong bảng
//      truncate: dùng để xóa trắng bảng ghi

//        Tag::factory(15)->create();
//
//        foreach (['S', 'M', 'XL', 'XXl'] as $item) {
//            ProductSize::query()->create([
//                'name' => $item
//            ]);
//        }

        for ($i = 1; $i < 11; $i++) {
            Voucher::query()->create(
//                [
//                    'name' => 'Mã giảm ' . $i . '00K',
//                    'code' => 'magiam' . $i . '00k',
//                    'discount' => $i . '00',
//                    'quantity' => 10,
//                    'min_price' => $i . '000000',
//                    'total' => $i . '00000',
//                    'type' => Voucher::TYPE_FIXED,
//                    'is_active' => true,
//                ],
                [
                    'name' => 'Mã giảm ' . $i . '0%',
                    'code' => 'magiam' . $i . '0%',
                    'discount' => $i . '0',
                    'quantity' => 5,
                    'min_price' => 1000000,
                    'total' => 5000000,
                    'type' => Voucher::TYPE_PERCENTAGE,
                    'is_active' => true,
                ]
            );
        }

//        for ($i = 1; $i < 3; $i++) {
//            ProductGallery::query()->insert([
//                [
//                    'product_id' => $i,
//                    'image' => 'https://antimatter.vn/wp-content/uploads/2022/10/hinh-anh-gai-xinh-de-thuong-dep-nhat-viet-nam.jpg'
//                ],
//                [
//                    'product_id' => $i,
//                    'image' => 'https://clipnong.us/wp-content/uploads/2022/08/thuy-hang-2k1-lo-clip-nong6.jpg'
//                ]
//            ]);
//        }
//
//        for ($i = 1; $i < 3; $i++) {
//            DB::table('product_tag')->insert([
//                [
//                    'product_id' => $i,
//                    'tag_id' => rand(1, 8)
//                ],
//                [
//                    'product_id' => $i,
//                    'tag_id' => rand(9, 15)
//                ],
//            ]);
//        }
//
//        for ($productId = 1; $productId < 3; $productId++) {
//            $data = [];
//            for ($sizeId = 1; $sizeId < 5; $sizeId++) {
//                for ($colorId = 0; $colorId < 7; $colorId++) {
//                    $data[] = [
//                        'product_id' => $productId,
//                        'product_color_id' => $colorId,
//                        'product_size_id' => $sizeId,
//                        'quantity' => 100,
//                        'price' => 500000,
//                        'image' => 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain',
//                        'is_active' => true,
//                    ];
//                }
//            }
//            DB::table('product_variants')->insert($data);
//        }
    }
}
