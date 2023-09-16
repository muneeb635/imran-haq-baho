<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $suppliers = Supplier::all()->count();
            $customers = Customer::all()->count();
            return view('admin.dashboard', compact('suppliers', 'customers'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getProducts($category)
    {
        // Query your database to get products based on the selected category
        $products = Product::where('category_id', $category)->get();

        // Return the products as JSON
        return response()->json($products);
    }
}
