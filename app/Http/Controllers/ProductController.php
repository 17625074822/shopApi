<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * 展示商品列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return new ProductCollection($product);
    }

    /**
     * 创建一个商品
     *
     * @param \Illuminate\Http\Request $request
     * @return \IllumiSnate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //开启事务
        DB::beginTransaction();
        try {
            if (!Category::find($request->category_id)) {
                return response()->json([
                    'data' => '该分类不存在'
                ], 409);
            }
            $product = Product::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'sale_num' => 0,
                'content' => $request->product_content,
                'sort' => $request->sort,
                'status' => $request->status
            ]);
            $tag = $request->tag;
            $sku = $request->sku;
            $product->skus()->createMany($sku);
            $product->tags()->createMany($tag);
            DB::commit();
            return response()->json([
                'data'=>'创建成功'
            ]);
        } catch (\Exception $e) {
            //接收异常处理并回滚
            DB::rollBack();
            return [
                'status' => $e->getCode(),
                'msg' => $e->getMessage()
            ];
        }

    }

    /**
     * 显示单个商品
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
