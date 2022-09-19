<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(CategoryService $categoryService, Request $request)
    {
        $filter = [
            ...$request->query(),
            'paginate' => 5,
        ];
        $categories = $categoryService->getList($filter);
        
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StoreCategoryRequest $request, CategoryService $categoryService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $category = $categoryService->create($request->validated());
        if(is_null($category))
        {
            return back()->with('error', 'Failed create.');
        }

        return redirect('/category')
            ->with('success', 'Successfully created.');
    }

    public function edit($id)
    {
        $categories = Category::find($id);
        
        return view('admin.category.edit',['categories' => $categories]);
    }    

    public function update(UpdateCategoryRequest $request, Category $category, CategoryService $categoryService)
    {
        date_default_timezone_set('asia/ho_chi_minh');

        $categoryService->update($request->validated(), $category);
        
        return redirect('/category')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Category $category, CategoryService $categoryService)
    {
        $categoryService->delete($category);

        return redirect('/category')
            ->with('success', 'Successfully deleted.');
    }
        
    public function show()
    {

    }
}
