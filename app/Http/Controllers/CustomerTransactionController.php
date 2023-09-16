<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\CustomerTransaction;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CustomerTransactionController extends Controller
{
    public function add($id)
    {
        try {
            $categories = Category::all();
            $products = Product::all();
            return view('admin.customerTrans.add', compact('id', 'categories', 'products'));
        } catch (\Throwable $th) {
            return redirect(route('dashboard'))->with(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $billName=null;
            $customer = Customer::findorfail($request->id);

            if ($request->hasFile('bill_picture')) {
                $bill = $request->file('bill_picture');
                $billName = time() . '_' . $bill->getClientOriginalName();
                $bill->storeAs('images/bills', $billName);
            }

            if ($request->in) {
                $remaining = $customer->balance + $request->in;
                CustomerTransaction::create([
                    'date' => $request->date,
                    'bill_no' => $request->bill_no,
                    'bill_picture' => $billName,
                    'in' => $request->in,
                    'remaining' => $remaining,
                    'customer_id' => $request->id,
                ]);
                $customer->update([
                    'id' => $customer->id,
                    'balance' => $customer->balance + $request->in,
                ]);
                $product = Product::findorfail($request->product);
                $product->update([
                    'id' => $product->id,
                    'quantity' => $product->quantity - $request->quantity,
                ]);
                DB::commit();
                return redirect(route('customer.list'))->with(['status' => true, 'message' => 'Bill Added Successfully']);
            }
            if ($request->deposit) {
                $remaining = $customer->balance - $request->deposit;
                CustomerTransaction::create([
                    'date' => $request->date,
                    'out' => $request->deposit,
                    'remaining' => $remaining,
                    'customer_id' => $request->id,
                ]);
                $customer->update([
                    'id' => $customer->id,
                    'balance' => $customer->balance - $request->deposit,
                ]);
                $user->update([
                    'id' => $user->id,
                    'myAccount' =>  $user->myAccount + $request->deposit,
                ]);

                DB::commit();
                return redirect(route('customer.list'))->with(['status' => true, 'message' => 'Sent Money Successfully']);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
        }
    }
    public function sendMoney($id)
    {
        try {
            $customer = Customer::findorfail($id);
            return view('admin.customerTrans.deposit', compact('customer'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function details($id)
    {
        try {
            $customer = Customer::findorfail($id);
            $transactions = $customer->customerTransactions()->orderBy('date', 'desc')->get();
            return view('admin.customerTrans.details', compact('transactions', 'customer'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
