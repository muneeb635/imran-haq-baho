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
            <h2 class="text-center mt-3"><strong>All Suppliers</strong></h2>
            <div class="text-left">
                <a href="{{ route('supplier.add') }}" class="btn btn-sm btn-success">Add Supplier</a>
            </div>
            <section class="mt-3">
                <div class="container">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($suppliers as $supplier)
                                    @php
                                        $counter = $counter + 1;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $counter }}</th>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->balance }}</td>
                                        <td>
                                            <a href="{{ route('transaction.add', $supplier->id) }}"
                                                class="btn btn-sm btn-danger">Add Bill</a>
                                            <a href="{{ route('transaction.send', $supplier->id) }}"
                                                class="btn btn-sm btn-warning">Send Money</a>
                                            <a href="{{ route('transaction.details', $supplier->id) }}"
                                                class="btn btn-sm btn-secondary">Transactions</a>
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
