<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function add()
    {
        try {
            return view('admin.supplier.add');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            Supplier::create([
                'name' => $request->name,
                'balance' => $request->balance,
            ]);
            DB::commit();
            return redirect(route('supllier.list'))->with(['status' => true, 'message' => 'Supplier Added Successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect(route('supllier.list'))->with(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function list()
    {
        try {
            $suppliers = Supplier::paginate(8);
            return view('admin.supplier.list', compact('suppliers'));
        } catch (\Throwable $th) {
            return redirect(route('dashboard'))->with(['status' => false, 'message' => 'something went wrong']);
        }
    }
}
