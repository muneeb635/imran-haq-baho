@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center">

                <div class="container">
                    <h3 class="py-3 text-center">{{ $supplier->name }} </h3>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Bill No</th>
                        <th scope="col">Bill Picture</th>
                        <th scope="col">In</th>
                        <th scope="col">Out</th>
                        <th scope="col">Remaining</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->date }}</td>
                            <td>{{ $transaction->bill_no }}</td>
                            @if ($transaction->bill_picture)
                                <td><img src="{{ asset('images/bills/' . $transaction->bill_picture) }}" alt="hi">
                                </td>
                            @else
                                <td></td>
                            @endif
                            <td><span class="badge bg-danger ">{{ $transaction->in }}</span></td>
                            @if ($transaction->out)
                                <td><span class="badge bg-success "> {{ $transaction->out }}</span></td>
                            @else
                                <td></td>
                            @endif
                            <td>{{ $transaction->remaining }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
