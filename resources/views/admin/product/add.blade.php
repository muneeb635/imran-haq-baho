@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="container">
                        <h2 class="py-3 text-center">Add Product</h2>
                        <form action="{{ route('product.store') }}" method="POST">
                            @csrf
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                                <input name="name" type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" {{ old('name') }}>
                            </div>
                            @error('name')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Category</span>
                                <select name="category" id="category" class="form-control">
                                    <option disabled selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Quantity</span>
                                <input name="quantity" type="number" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" {{ old('quantity') }}>
                            </div>
                            @error('quantity')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Price Per Unit</span>
                                <input name="pricePerUnit" type="number" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                    {{ old('pricePerUnit') }}>
                            </div>
                            @error('pricePerUnit')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror

                            <div class="container mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Add Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
