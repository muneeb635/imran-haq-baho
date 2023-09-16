@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        @if (Session::has('message'))
            <div class="alert">
                @if (Session::get('status') == false)
                    <p class="alert alert-danger">{{ Session::get('message') }}</p>
                @else
                    <p class="alert alert-success">{{ Session::get('message') }}</p>
                @endif
            </div>
        @endif
        <div class="container-fluid">
            <h2 class="text-center mt-3"><strong>All Products </strong></h2>
            <section style="padding-top:60px">
                <div class="container">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price Per Unit</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($products as $product)
                                    @php
                                        $counter = $counter + 1;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $counter }}</th>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->price_per_unit }}</td>
                                        <td><a href="{{ route('product.salePage', $product->id) }}"
                                                class="btn btn-sm btn-danger">Sale
                                                Item</a></td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
