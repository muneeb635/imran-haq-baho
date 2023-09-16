@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="container">
                        <h2 class="py-3 text-center">Add Expense</h2>
                        <form action="{{ route('expense.store') }}" method="POST">
                            @csrf
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Date:</span>
                                <input name="date" type="date" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" value="{{ date('Y-m-d') }}">
                                {{-- <label for="date">Date:</label>
                                <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}" required> --}}
                            </div>
                            @error('date')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
                                <input name="description" type="text" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                            @error('description')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Amount</span>
                                <input name="amount" type="numeric" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                            @error('amount')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="container mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Add Expense</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
