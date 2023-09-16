<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function add()
    {
        try {
            return view('admin.customer.add');
        } catch (\Throwable $th) {
            return redirect(route('dashboard'))->with(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            Customer::create([
                'name' => $request->name,
                'balance' => $request->balance,
            ]);
            DB::commit();
            return redirect(route('customer.list'))->with(['status' => true, 'message' => 'Customer Added Successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect(route('customer.list'))->with(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function list()
    {
        try {
            $customers = Customer::all();
            return view('admin.customer.list', compact('customers'));
        } catch (\Throwable $th) {
            return redirect(route('dashboard'))->with(['status' => false, 'message' => 'something went wrong']);
        }
    }
}
