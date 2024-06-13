<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannerMkt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerMktController extends Controller
{
    const PATH_URL = 'admin.bannerMkts.';
    const PATH_UPLOAD = 'bannerMkts';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bannerAll = BannerMkt::query()->get();
        return view(self::PATH_URL . __FUNCTION__,compact('bannerAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_URL . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->is_active ??= 0;
        if ($request->hasFile('url')) {
            foreach ($request->url as $url) {
                BannerMkt::query()->create([
                    'url' => Storage::put(self::PATH_UPLOAD, $url),
                    'is_active' => $request->is_active
                ]);
            }
            return redirect('admin/bannerMkts')->with('msg', 'Cập nhật sản phẩm thành công');;
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(BannerMkt $bannerMkt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BannerMkt $bannerMkt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BannerMkt $bannerMkt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BannerMkt $bannerMkt)
    {
        //
    }
}
