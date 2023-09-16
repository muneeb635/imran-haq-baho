@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="container">
                        <h2 class="py-3 text-center">Sale Item</h2>
                        <form action="{{ route('product.sale') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Quantity</span>
                                <input name="quantity" type="number" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" {{ old('quantity') }}>
                            </div>
                            @error('quantity')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="container mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Sale Item</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
