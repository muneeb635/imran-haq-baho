@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="container">
                        <h2 class="py-3 text-center">Add Bill</h2>
                        <form action="{{ route('transaction.customer.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Date</span>
                                <input name="date" type="date" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" {{ old('date') }}>
                            </div>
                            @error('date')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Bill No</span>
                                <input name="bill_no" type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" {{ old('name') }}>
                            </div>
                            @error('bill_no')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Bill Picture</span>
                                <input name="bill_picture" type="file" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                    {{ old('bill_picture') }}>
                            </div>
                            @error('bill_picture')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Bill Amount</span>
                                <input name="in" type="numeric" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" {{ old('in') }}>
                            </div>
                            @error('in')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror

                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select id="category" name="category" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product">Product:</label>
                                <select id="product" name="product" class="form-control">
                                    <option value="">Select Product</option>
                                </select>
                            </div>
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Quantity</span>
                                <input name="quantity" type="numeric" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" {{ old('quantity') }}>
                            </div>
                            @error('quantity')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror

                            <div class="container mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Add Bill</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
