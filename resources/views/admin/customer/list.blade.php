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
            <h2 class="text-center mt-3"><strong>All Customers</strong></h2>
            <section style="padding-top:60px">
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
                                @foreach ($customers as $customer)
                                    @php
                                        $counter = $counter + 1;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $counter }}</th>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->balance }}</td>
                                        <td>
                                            <a href="{{ route('transaction.customer.add', $customer->id) }}"
                                                class="btn btn-danger">Add Bill</a>
                                            <a href="{{ route('transaction.customer.send', $customer->id) }}"
                                                class="btn btn-success">Receive Money</a>
                                            <a href="{{ route('transaction.customer.details', $customer->id) }}"
                                                class="btn btn-secondary">Transactions</a>
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
