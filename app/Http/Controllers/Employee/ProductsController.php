<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImgUploading;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use ImgUploading;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('employee.manager.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('name_category', 'id');
        return view('employee.manager.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $products = Product::create($request->validated());
        foreach ($request->input('gallery', []) as $file) {
            $products->addMedia(storage_path('tmp/uploads/') . $file)->toMediaCollection('gallery');
        }

        Toastr::success('Product Created Successfully!', 'Success', ["progressBar" => true,]);

        return redirect()->route('products.index')->with([
            'message' => 'Product Created Successfully',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('employee.manager.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::pluck('name_category', 'id');

        return view('employee.manager.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        if (count($product->gallery) > 0) {
            foreach ($product->gallery as $media) {
                if (!in_array($media->file_name, $request->input('gallery'))) {
                    $media->delete();
                }
            }
        }

        $media = $product->gallery->pluck('file_name')->toArray();

        foreach ($request->input('gallery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/') . $file)->toMediaCollection('gallery');
            }
        }

        Toastr::info('Product Updated Successfully!', 'Success', ["progressBar" => true,]);

        return redirect()->route('products.index')->with([
            'message' => 'Product Updated Successfully',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->status == 'unactive') {
            $product->update([
                'status' => 'active'
            ]);
            return response()->json(['status' => 'Product is Active!']);
        } else {
            $product->update([
                'status' => 'unactive'
            ]);

            return response()->json(['status' => 'Product is Unactive!']);
        }
    }
}
