<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function addPage()
    {
        try {
            return view('admin.category.add');
        } catch (\Throwable $th) {
            return redirect(route('dashboard'))->with(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            Category::create([
                'name' => $request->name,
            ]);
            DB::commit();
            return redirect(route('category.list'))->with(['status' => true, 'message' => 'Category Added Successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect(route('category.list'))->with(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function list()
    {
        try {
            // $categories= Category::all();
            $categories = Category::select('categories.id', 'categories.name')
                ->join('products', 'categories.id', '=', 'products.category_id')
                ->groupBy('categories.id', 'categories.name')
                ->selectRaw('SUM(products.quantity) as total_quantity')
                ->get();

            return view('admin.category.list', compact('categories'));
        } catch (\Throwable $th) {
            return redirect(route('dashboard'))->with(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $category = Category::findorfail($id);
            $category->delete();
            DB::commit();
            return redirect(route('category.list'))->with(['status' => true, 'message' => 'Category Deleted successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
