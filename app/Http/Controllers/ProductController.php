<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function add()
    {
        try {
            $categories = Category::all();
            return view('admin.product.add', compact('categories'));
        } catch (\Throwable $th) {
            return redirect(route('dashboard'))->with(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            Product::create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price_per_unit' => $request->pricePerUnit,
                'category_id' => $request->category,
            ]);
            DB::commit();
            return redirect(route('product.list'))->with(['status' => true, 'message' => 'Product Added Successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect(route('product.list'))->with(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function list()
    {
        try {
            $products = Product::all();
            return view('admin.product.list', compact('products'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function salePage($id)
    {
        try {
            $product = Product::findorfail($id);
            return view('admin.product.sale', compact('product'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function sale(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::findorfail($request->product_id);
            $product->update([
                'id' => $product->id,
                'quantity' => $product->quantity - $request->quantity,
            ]);
            DB::commit();
            return redirect(route('product.list'))->with(['status' => true, 'message' => 'Stock Updated Successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect(route('product.list'))->with(['status' => false, 'message' => 'Something went wrong']);
        }
    }
}
