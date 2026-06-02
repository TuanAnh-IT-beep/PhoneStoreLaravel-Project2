<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category', 'manufacturer', 'subproducts')->get();

        return view('admins.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $manufacturers = Manufacturer::all();

        return view('admins.products.create', compact('categories', 'manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->all();
        $data['feature'] = $request->has('feature') ? 1 : 0;
        $product = Product::create($data);

        $newImagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path,
                ]);
                $newImagePaths[] = $path;
            }
        }

        if ($request->has('thumbnail_image') && str_starts_with($request->thumbnail_image, 'new_')) {
            $index = (int) str_replace('new_', '', $request->thumbnail_image);
            if (isset($newImagePaths[$index])) {
                $product->update(['thumbnail_path' => $newImagePaths[$index]]);
            }
        } elseif (count($newImagePaths) > 0) {
            $product->update(['thumbnail_path' => $newImagePaths[0]]);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        $product->load('images');

        return view('admins.products.edit', compact('product', 'categories', 'manufacturers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->all();
        $data['feature'] = $request->has('feature') ? 1 : 0;
        $deletedPaths = [];

        // kiểm tra có ảnh nào bị đánh dấu xóa
        if ($request->has('deleted_images')) {
            $imagesToDelete = ProductImage::whereIn('id', $request->deleted_images)->where('product_id', $product->id)->get();
            foreach ($imagesToDelete as $img) {
                $deletedPaths[] = $img->path;
                // xóa ảnh khỏi kho lưu trữ
                if (Storage::disk('public')->exists($img->path)) {
                    Storage::disk('public')->delete($img->path);
                }
                // xóa khỏi cơ sở dữ liệu
                $img->delete();
            }
        }

        $newImagePaths = [];
        // kiểm tra có upload ảnh mới hay không
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path,
                ]);
                $newImagePaths[] = $path;
            }
        }

        // kiểm tra có cập nhật thumbnail ảnh
        if ($request->has('thumbnail_image')) {
            $thumbnailVal = $request->input('thumbnail_image');
            if (str_starts_with($thumbnailVal, 'new_')) {
                $index = (int) str_replace('new_', '', $thumbnailVal);
                if (isset($newImagePaths[$index])) {
                    $data['thumbnail_path'] = $newImagePaths[$index];
                }
            } else {
                if (in_array($thumbnailVal, $deletedPaths)) {
                    $data['thumbnail_path'] = null;
                } else {
                    $data['thumbnail_path'] = $thumbnailVal;
                }
            }
        }

        // trường hợp không có ảnh được chọn làm thumbnail, chọn ảnh đầu tiên làm thumbnail hoặc để null nếu không có ảnh
        if (! isset($data['thumbnail_path']) || $data['thumbnail_path'] === null) {
            $firstImage = $product->images()->first();
            if ($firstImage) {
                $data['thumbnail_path'] = $firstImage->path;
            } elseif (count($newImagePaths) > 0) {
                $data['thumbnail_path'] = $newImagePaths[0];
            } else {
                $data['thumbnail_path'] = null;
            }
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->images()->delete();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Upload image from TinyMCE.
     */
    public function uploadImage(\Illuminate\Http\Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('product_descriptions', 'public');
            return response()->json(['location' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
