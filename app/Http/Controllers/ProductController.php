<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use App\Sku;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $tags = $request->tag;
            $skus = $request->sku;
            $product->skus()->createMany($skus);
            $product->tags()->createMany($tags);
            DB::commit();
            return response()->json([
                'data' => '创建成功'
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
     * 编辑商品
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $input = $request->all();
        //开启事务
        DB::beginTransaction();
        try {
            if (!Category::find($input['category_id'])) {
                return response()->json([
                    'data' => '该分类不存在'
                ], 409);
            }
            $product->update([
                'category_id' => $input['category_id'],
                'name' => $input['name'],
                'content' => $input['content'],
                'sort' => $input['sort'],
                'status' => $input['status']
            ]);
            $tags = $input['tag'];
            foreach ($tags as $tag) {
                Tag::where('id', $tag['id'])->update($tag);
            }
            $skus = $input['sku'];
            foreach ($skus as $sku) {
                Sku::where('id', $sku['id'])->update($sku);
            }
            DB::commit();
            return response()->json([
                'data' => '修改成功'
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
     * 删除商品
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            $skus = $product->skus;
            foreach ($skus as $sku) {
                $sku->delete();
            }
            $tags = $product->tags;
            foreach ($tags as $tag) {
                $tag->delete();
            }
            $product->delete();
            DB::commit();
        } catch (\Exception $e) {
            //接收异常处理并回滚
            DB::rollBack();
            return [
                'status' => $e->getCode(),
                'msg' => $e->getMessage()
            ];
        }
        return response()->json([
            'data' => '删除成功'
        ]);
    }
}
