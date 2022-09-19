<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Color;
use App\Services\ColorService;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(ColorService $colorService, Request $request)
    {
        $filter = [
            ...$request->query(),
            'paginate' => 5,
        ];
        $colors = $colorService->getList($filter);
        
        return view('admin.color.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.color.create');
    }

    public function store(StoreColorRequest $request, ColorService $colorService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $color = $colorService->create($request->validated());
        if(is_null($color))
        {
            return back()->with('error', 'Failed create.');
        }

        return redirect('/color')
            ->with('success', 'Successfully created.');
    }

    public function edit($id)
    {
        $colors = Color::find($id);
        
        return view('admin.color.edit',['colors' => $colors]);
    }    

    public function update(UpdateColorRequest $request, Color $color, ColorService $colorService)
    {
        date_default_timezone_set('asia/ho_chi_minh');

        $colorService->update($request->validated(), $color);
        
        return redirect('/color')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Color $color, ColorService $colorService)
    {
        $colorService->delete($color);

        return redirect('/color')
            ->with('success', 'Successfully deleted.');
    }
        
    public function show()
    {

    }
}
