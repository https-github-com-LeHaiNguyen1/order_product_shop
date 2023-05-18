<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Import Validator
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Retrieving a paginated list of products from the database using the `Products` model and
        returning it as a JSON response with a status code of 200. */
        $product = Products::orderBy('create_at', ' desv')->paginate();
        return response()->json($product, 200);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:3',
                'image' => 'required|image|mimes:png,jpg,jpeg'
            ]);

            $product = new Products();
            $product->name = $request->name;

            $path = $request->file('image')->store('products_images');

            $product->image = $path;

            if ($product->save()) {
                $tmp = [];
                return response()->json($tmp, 200);
            }
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        $tmp = (new Products())->get();
        if (!empty($tmp)) {
            $res = $tmp->toArray();
        }
        return response()->json($res, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'name' => 'required|min:3',
        ]);


    
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu dựa trên $id
        $product = Products::find($id);
    
        if (!$product) {
            return response()->json([
                'message' => 'Sản phẩm không tồn tại',
                'status_code' => 404
            ], 404);
        }
    
        // Cập nhật thông tin sản phẩm
        $product->name = $request->name;
        $oldPath = $product->image;
    
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg'
            ]);
            $path = $request->file('image')->store('products_image');
            $product->image = $path;
    
            // Xóa hình ảnh cũ
            Storage::delete($oldPath);
        }
    
        if ($product->save()) {
            return response()->json($product, 200);
        } else {
            // Xóa hình ảnh mới nếu có lỗi khi lưu vào cơ sở dữ liệu
            Storage::delete($path);
    
            return response()->json([
                'message' => 'Đã xảy ra lỗi, vui lòng thử lại!',
                'status_code' => 500
            ], 500);
        }
    }
    
    
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Products $products)
    // {
    //     try {
    //         // Tìm sản phẩm theo ID
    //         $product = Products::findOrFail($products->id);

    //         // Xóa sản phẩm
    //         $product->delete();

    //         // Trả về phản hồi thành công
    //         return response()->json(['message' => 'Xóa sản phẩm thành công'], 200);
    //     } catch (\Exception $e) {
    //         // Xử lý lỗi nếu có
    //         return response()->json(['message' => 'Xóa sản phẩm thất bại'], 500);
    //     }
    // }

        // public function destroy(Products $request, $id)
    // {
    //     try {
    //         // Tìm sản phẩm theo ID
    //         $product = Products::find($id)->delete();
    //         // Trả về phản hồi thành công
    //         return response()->json(['message' => 'Xóa sản phẩm thành công', 'data' => [], 'status' => true], 200);
    //     } catch (\Exception $e) {
    //         // Xử lý lỗi nếu có
    //         return response()->json(['message' => $e->getMessage(), 'data' => [], 'status' => false], 500);
    //     }
    // }
    public function destroy(Request $request, $id)
    {
        if (is_array($id)) 
        {
            Products::destroy($id);
        }
        else
        {
            Products::findOrFail($id)->delete();
        }
        // try {
        //     // Tìm sản phẩm theo ID và xóa
        //     Products::destroy($id);
        //     // Trả về phản hồi thành công
        //     return response()->json(['message' => 'Xóa sản phẩm thành công', 'data' => [], 'status' => true], 200);
        // } catch (\Exception $e) {
        //     // Xử lý lỗi nếu có
        //     return response()->json(['message' => $e->getMessage(), 'data' => [], 'status' => false], 500);
        // }
    }
}