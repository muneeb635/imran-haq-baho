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
            <h2 class="text-center mt-3">
                <strong>
                    All Categories
                </strong>
            </h2>
            <!-- Add the button here -->
            <div class="text-left">
                <a href="{{ route('category.add') }}" class="btn btn-sm btn-success">Add Category</a>
            </div>
            <section class="mt-3">
                <div class="container">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Products</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($categories as $category)
                                    @php
                                        $counter = $counter + 1;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $counter }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->total_quantity }}</td>
                                        <td>
                                            <form action="{{ route('category.delete', $category->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
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
