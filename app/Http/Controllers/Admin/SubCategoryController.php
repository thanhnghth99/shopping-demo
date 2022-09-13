<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\SubCategoryService;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(SubCategoryService $subCategoryService, Request $request)
    {
        $filter = [
            ...$request->query(),
            'paginate' => 10,
        ];
        $subCategories = $subCategoryService->getList($filter);
        return view('admin.subcategory.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::all()->sortBy('name');
        return view('admin.subcategory.create', ['categories' => $categories]);
    }

    public function store(StoreSubCategoryRequest $request, SubCategoryService $subCategoryService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $subCategories = $subCategoryService->create($request->validated());
        if(is_null($subCategories))
        {
            return back()->with('error', 'Failed create.');
        }

        return redirect('/subcategory')
            ->with('success', 'Successfully created.');
    }

    public function edit($id)
    {
        $subCategory = SubCategory::with('category')->find($id);
        $categories = Category::all();

        return view('admin.subcategory.edit',['subCategory' => $subCategory, 'categories' => $categories]);
    }    

    public function update(UpdateSubCategoryRequest $request, $id, SubCategoryService $subCategoryService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $subCategory = SubCategory::find($id);
        $subCategoryService->update($request->validated(), $subCategory);
        
        return redirect('/subcategory')
            ->with('success', 'Successfully updated.');
    }

    public function destroy($id, SubCategoryService $subCategoryService)
    {
        $subCategoryService->delete($id);
        return redirect('/subcategory')
            ->with('success', 'Successfully deleted.');
    } 
    
    public function show()
    {

    }
}
