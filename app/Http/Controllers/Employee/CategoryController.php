<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImgUploading;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ImgUploading;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('employee.manager.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('name_category', 'id');
        return view('employee.manager.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        if ($request->input('photo', false)) {
            $category->addMedia(storage_path('tmp/uploads/') . $request->input('photo'))->toMediaCollection('photo');
        }

        return redirect()->route('category.index')->with([
            'message' => 'Category Created Successfully',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::whereNull('category_id')->pluck('name_category', 'id');
        return view('employee.manager.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        if ($request->input('photo', false)) {
            if (!$category->photo || $request->input('photo') !== $category->photo->file_name) {
                isset($category->photo) ? $category->photo->delete() : null;
                $category->addMedia(storage_path('tmp/uploads/') . $request->input('photo'))->toMediaCollection('photo');
            }
        } else if ($category->photo) {
            $category->photo->deleted();
        }

        return redirect()->route('category.index')->with([
            'message' => 'Category Updated Successfully',
            'type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with([
            'message' => 'Category Deleted Successfully',
            'type' => 'danger'
        ]);
    }
}
