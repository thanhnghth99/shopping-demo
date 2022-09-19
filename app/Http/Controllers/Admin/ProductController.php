<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(ProductService $productService, Request $request)
    {
        $filter = [
            ...$request->query(),
            'paginate' => 5,
        ];
        $products = $productService->getList($filter);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        $subCategories = SubCategory::all();
        return view('admin.product.create', compact('colors', 'sizes', 'subCategories'));
    }

    public function store(StoreProductRequest $request, ProductService $productService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $product = $productService->create($request->validated());
        if(is_null($product))
        {
            return back()->with('error', 'Failed create,');
        }

        return redirect('/product')
            ->with('success', 'Successfully created.');
    }

    public function edit($id)
    {
        $products = Product::find($id);
        $colors = Color::all();
        $sizes = Size::all();
        $subCategories = SubCategory::all();

        return view('admin.product.edit', compact('products', 'colors', 'sizes', 'subCategories'));
    }

    public function update(UpdateProductRequest $request, ProductService $productService, Product $product)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $productService->update($request->validated(), $product);

        return redirect ('/product')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Product $product, ProductService $productService)
    {
        $productService->delete($product);
        return redirect('/product')
            ->with('success', 'Successfully deleted.');
    }

    public function show()
    {

    }
}
