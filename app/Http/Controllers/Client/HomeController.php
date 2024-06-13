<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\BannerMkt;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function home()
    {
        $dataCatelogues = Catelogue::query()
            ->orderByDesc('id')
            ->get();
        $product_hot_deal = Product::query()
            ->where('is_hot_deal', 1)
            ->orderByDesc('id')
            ->get();
        $product_good_deal = Product::query()
            ->where('is_good_deal', 1)
            ->orderByDesc('id')
            ->get();

        $bannerAll = BannerMkt::query()->where('is_active', true)->get();
//        dd($bannerAll);
        return view('client.home', compact('dataCatelogues', 'product_hot_deal', 'product_good_deal','bannerAll'));
    }

    public function detail($slug)
    {

        $productDetail = Product::query()->where('slug', $slug)->first();
        $productColor = ProductColor::query()->get();
        $productSize = ProductSize::query()->get();
        // cập nhật lượt xem
        Product::query()->where('slug', $slug)->update([
            'view_count' => $productDetail->view_count + 1
        ]);
        $productVariant = ProductVariant::query()
            ->with('product_color')
            ->where('product_id', $productDetail->id)
            ->get();

        return view('client.products.detail', compact('productDetail', 'productSize', 'productColor'));
    }

    public function list($catelogue = 0)
    {
        if ($catelogue) $productList = Product::query()
            ->where('catelogue_id', $catelogue)
            ->latest('id')->paginate(9);
        else $productList = Product::query()
            ->latest('id')
            ->paginate(9);
        return view('client.products.list', compact('productList'));
    }

}
