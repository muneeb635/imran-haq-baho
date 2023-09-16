<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function add($id)
    {
        try {
            $categories = Category::all();
            return view('admin.transaction.add', compact('id', 'categories'));
        } catch (\Throwable $th) {
            return redirect(route('dashboard'))->with(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $supplier = Supplier::findorfail($request->id);
            $billName=null;
            $user = Auth::user();

            if ($request->hasFile('bill_picture')) {
                $bill = $request->file('bill_picture');
                $billName = time() . '_' . $bill->getClientOriginalName();
                $bill->storeAs('images/bills', $billName);
            }

            if ($request->in) {
                $remaining = $supplier->balance + $request->in;
                Transaction::create([
                    'date' => $request->date,
                    'bill_no' => $request->bill_no,
                    'bill_picture' => $billName,
                    'in' => $request->in,
                    'remaining' => $remaining,
                    'supplier_id' => $request->id,
                ]);
                $supplier->update([
                    'id' => $supplier->id,
                    'balance' => $supplier->balance + $request->in,
                ]);

                Product::create([
                    'name' => $request->name,
                    'quantity' => $request->quantity,
                    'price_per_unit' => intval($request->in / $request->quantity),
                    'category_id' => $request->category,
                ]);

                DB::commit();
                return redirect(route('product.list'))->with(['status' => true, 'message' => 'Bill Added Successfully']);
            }
            if ($request->deposit) {
                $remaining = $supplier->balance - $request->deposit;
                Transaction::create([
                    'date' => $request->date,
                    'out' => $request->deposit,
                    'remaining' => $remaining,
                    'supplier_id' => $request->id,
                ]);
                $supplier->update([
                    'id' => $supplier->id,
                    'balance' => $supplier->balance - $request->deposit,
                ]);
                $user->update([
                    'id' => $user->id,
                    'myAccount' => $user->myAccount - $request->deposit,
                ]);
                DB::commit();
                return redirect(route('supllier.list'))->with(['status' => true, 'message' => 'Sent Money Successfully']);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
        }
    }
    public function sendMoney($id)
    {
        try {
            $supplier = Supplier::findorfail($id);
            return view('admin.transaction.deposit', compact('supplier'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function details($id)
    {
        try {
            $supplier = Supplier::findorfail($id);
            $transactions = $supplier->transactions()->orderBy('date', 'desc')->get();
            return view('admin.transaction.details', compact('transactions', 'supplier'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
