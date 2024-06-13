<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const PATH_VIEW = 'admin.products.';
    const PATH_UPLOAD = 'products';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::query()->with(['catelogue', 'tags'])->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataCatelogues = Catelogue::query()->latest('id')->get();
        $dataColor = ProductColor::query()->latest('id')->get();
        $dataSize = ProductSize::query()->latest('id')->get();
        $dataTag = Tag::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['dataCatelogues', 'dataSize', 'dataColor', 'dataTag']));
    }

    public function store(StoreProductRequest $request)
    {
        //  sản phẩm
        $products = $request->except('img_thumbnail', 'product_galleries', 'product_tags', 'product_variants');
        $products['name'] = mb_convert_case($products['name'], MB_CASE_TITLE);
        $products['sku'] = strtoupper($products['sku']);
        $products['slug'] = Str::slug($products['name'] . '-' . $products['sku']);
        $products['is_active'] ??= 0;
        $products['is_hot_deal'] ??= 0;
        $products['is_good_deal'] ??= 0;
        $products['is_new'] ??= 0;
        $products['is_home'] ??= 0;
        $products['img_thumbnail'] = $request->hasFile('img_thumbnail') ? Storage::put(self::PATH_UPLOAD, $request->img_thumbnail) : null;

        //  sản phẩm biến thể
        $product_variantsTmp = $request->product_variants;
        $product_variants = [];
        foreach ($product_variantsTmp as $key => $val) {
            $Tmp = explode('-', $key);
            $is_check = true;
            if (!$val['quantity'] || !$val['price']) {
                $is_check = false;

            }

            $product_variants[] = [
                'product_color_id' => $Tmp[0],
                'product_size_id' => $Tmp[1],
                'quantity' => $val['quantity'],
                'price' => $val['price'],
                'image' => $val['image']?? null,
                'is_active' => $is_check,
            ];
        }
        //  ảnh chi tiết sản phẩm
        $product_galleries = $request->product_galleries;

        //  tag
        $product_tags = $request->product_tags;

        try {
            DB::beginTransaction();
            /** @var Product $product */
            $product = Product::query()->create($products);

            foreach ($product_variants as $product_variant) {
                $product_variant['product_id'] = $product->id;
                if ($product_variant['image']) {
                    $product_variant['image'] = Storage::put(self::PATH_UPLOAD, $product_variant['image']);
                }
                ProductVariant::query()->create($product_variant);
            }

            $product->tags()->sync($product_tags);

            if ($product_galleries) {
                foreach ($product_galleries as $gallery) {
                    ProductGallery::query()->create([
                        'product_id' => $product->id,
                        'image' => Storage::put(self::PATH_UPLOAD, $gallery)
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.products.index')->with('msg', 'Thêm sản phẩm thành công');
        } catch (\Exception $exception) {
            if ($product_galleries) {
                foreach ($product_galleries as $gallery) {
                    Storage::delete($gallery);
                }
            }
            if ($products['img_thumbnail']) Storage::delete($products['img_thumbnail']);

            DB::rollBack();
            //            dd($exception->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $dataCatelogues = Catelogue::query()->latest('id')->get();
        $dataTag = Tag::query()->latest('id')->get();
        $dataGalleries = ProductGallery::query()
            ->where('product_id', $product->id)
            ->latest('id')
            ->get();
        $product_variants = ProductVariant::query()
            ->with('product_size', 'product_color')
            ->where('product_id', $product->id)
            ->orderBy('id', 'asc')
            ->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['dataCatelogues', 'product_variants', 'dataTag', 'product', 'dataGalleries']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $dataCatelogues = Catelogue::query()->latest('id')->get();
        $dataTag = Tag::query()->latest('id')->get();
        $dataGalleries = ProductGallery::query()->where('product_id', $product->id)->latest('id')->get();
        $product_variants = ProductVariant::query()
            ->with('product_size', 'product_color')
            ->where('product_id', $product->id)
            ->orderBy('id', 'asc')
            ->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['dataCatelogues', 'product_variants', 'dataTag', 'product', 'dataGalleries']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $model = Product::query()->findOrFail($product->id);
        $currentImg = $model->img_thumbnail;
        $data = $request->except('img_thumbnail');
        $data['name'] = mb_convert_case($data['name'], MB_CASE_TITLE);
        $data['sku'] = strtoupper($data['sku']);
        $data['slug'] = Str::slug($data['name'] . $data['sku']);
        $data['is_active'] ??= 0;
        $data['is_hot_deal'] ??= 0;
        $data['is_good_deal'] ??= 0;
        $data['is_new'] ??= 0;
        $data['is_home'] ??= 0;
//        dd($data);
        if ($request->hasFile('img_thumbnail')) {
            $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->img_thumbnail);
        }

        $product->update($data);
        
        if ($request->hasFile('img_thumbnail') && $currentImg && Storage::exists($currentImg)) {
            Storage::delete($currentImg);
        }
        return redirect()->route('admin.products.index')->with('msg', 'Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //        xóa ảnh sản phẩm
        if ($product->img_thumbnail) Storage::delete($product->img_thumbnail);

        foreach ($product->galleries->all() as $val) {
//            dd($val['image']);
            if ($val['image']) Storage::delete($val['image']);
        }

        foreach ($product->variants->all() as $val) {
            if ($val['image']) Storage::delete($val['image']);
        }

        try {
            DB::transaction(function () use ($product) {
                $product->tags()->sync([]);
                $product->galleries()->delete();
                $product->variants()->delete();
                $product->delete();
            });

            DB::commit();
            return back()->with('msg', 'Xóa sản phẩm thành công');
        } catch (\Exception $exception) {
            return back()->with('msg', 'Xóa sản phẩm thất bại');
        }
    }
}
