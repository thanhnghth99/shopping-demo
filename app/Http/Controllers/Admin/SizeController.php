<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\Size;
use App\Services\SizeService;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(SizeService $sizeService, Request $request)
    {
        $filter = [
            ...$request->query(),
            'paginate' => 5,
        ];
        $sizes = $sizeService->getList($filter);

        return view('admin.size.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.size.create');
    }

    public function store(StoreSizeRequest $request, SizeService $sizeService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $size = $sizeService->create($request->validated());
        if(is_null($size))
        {
            return back()->with('error', 'Failed create.');
        }

        return redirect('/size')
            ->with('success', 'Successfully created.');
    }

    public function edit($id)
    {
        $sizes = Size::find($id);
        
        return view('admin.size.edit',['sizes' => $sizes]);
    }    

    public function update(UpdateSizeRequest $request, Size $size, SizeService $sizeService)
    {
        date_default_timezone_set('asia/ho_chi_minh');

        $sizeService->update($request->validated(), $size);
        
        return redirect('/size')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Size $size, SizeService $sizeService)
    {
        $sizeService->delete($size);

        return redirect('/size')
            ->with('success', 'Successfully deleted.');
    }
        
    public function show()
    {

    }
}
