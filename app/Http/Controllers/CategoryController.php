<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * 展示分类列表
     *
     * @return  分类列表集合
     */
    public function index()
    {
        $categorys = Category::all();
        return new CategoryCollection($categorys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 创建一个分类对象
     *
     * @param \Illuminate\Http\StoreCategoryRequest $request
     * @return 创建的分类对象
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'property' => $request->property,
            'sort' => $request->sort,
            'status' => $request->status
        ]);
        return response()->json([
            'data' => new  CategoryResource($category)
        ], 201);
    }

    /**
     * 展示单个列表
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * 编辑导航
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $arr = [
            'attr1' => $request->attr1,
            'attr2' => $request->attr2,
            'attr3' => $request->attr3
        ];
        $category->name = $request->name;
        $category->property = json_encode($arr, JSON_UNESCAPED_UNICODE);
        $category->sort = $request->sort;
        $category->sort = $request->sort;
        $category->status = $request->status;
        $category->save();
        return new CategoryResource($category);
    }

    /**
     * 删除一个导航
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->status = 3;
        $category->save();
        return response()->json([
            'data' => '删除成功'
        ], 204);
    }
}
