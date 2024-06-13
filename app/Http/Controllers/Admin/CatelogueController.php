<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatelogueController extends Controller
{
    const PATH_VIEW = 'admin.catelogues.';
    const PATH_UPLOAD = 'catelogues';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Catelogue::query()->latest('id')->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('cover')) {
            $data = $request->except('cover');
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));
            $data['is_active'] = $request->is_active == 'on' ? true : false;
            Catelogue::query()->create($data);
            return redirect()
                ->route('admin.catelogues.index')
                ->with('msg', 'Thêm mới thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Catelogue $catelogue)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catelogue $catelogue)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('catelogue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Catelogue $catelogue)
    {
        $model = Catelogue::query()->findOrFail($catelogue->id);
        $data = $request->except('cover');
        $data['is_active'] = $request->is_active == 'on' ? true : false;
        if ($request->hasFile('cover')) {
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));
        }
        $currentImage = $model->cover;
        $model->update($data);

        if ($request->hasFile('cover') && $currentImage && Storage::exists($currentImage)) {
            Storage::delete($currentImage);
        }

        return redirect()
            ->route('admin.catelogues.index')
            ->with('msg', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catelogue $catelogue)
    {
        $catelogue->delete();
        return back()->with('msg', 'Xóa thành công');
    }
}
