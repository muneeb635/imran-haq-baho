<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function list()
    {
        try {
            $expenses = Expense::orderBy('created_at', 'desc')->get();
            return view('admin.expense.list', compact('expenses'));
        } catch (\Throwable $th) {
            return redirect(route('dashboard'))->with(['status' => false, 'message' => 'soemthing went wrong']);
        }
    }
    public function add()
    {
        try {
            return view('admin.expense.add');
        } catch (\Throwable $th) {
            return redirect(route('dashboard'))->with(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            Expense::create([
                'date' => $request->date,
                'description' => $request->description,
                'amount' => $request->amount,
                'myAccountBalance' => Auth::user()->myAccount - $request->amount,
            ]);
            $user = Auth::user();
            $user->update([
                'id' => $user->id,
                'myAccount' => $user->myAccount - $request->amount,
            ]);
            DB::commit();
            return redirect(route('expense.list'))->with(['status' => true, 'message' => 'Expense Added Successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
            return redirect(route('expense.list'))->with(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function byDate(Request $request)
    {
        try {
            $expenses = Expense::where('date', $request->date)->orderBy('created_at')->get();
            return view('admin.expense.list', compact('expenses'));
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
