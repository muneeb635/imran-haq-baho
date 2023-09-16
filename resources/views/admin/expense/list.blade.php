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
        <form action="{{ route('expense.byDate') }}" method="GET">
            @csrf
            <input type="date" name="date" id="date">
            <button type="submit">Find</button>
        </form>
        <div class="container-fluid">
            <h2 class="text-center mt-3"><strong>Expenses</strong></h2>
            <section style="padding-top:60px">
                <div class="container">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Amount</th>
                                    {{-- <th scope="col">My Acoount Balance</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 0;
                                @endphp
                                @if (Route::is('expense.byDate'))
                                    @foreach ($expenses as $expense)
                                        @php
                                            $counter = $counter + 1;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $counter }}</th>
                                            <td>{{ $expense->date }}</td>
                                            <td>{{ $expense->description }}</td>
                                            <td>{{ $expense->amount }}</td>
                                            {{-- <td>{{ $expense->myAccountBalance }}</td> --}}
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach ($expenses as $expense)
                                        @php
                                            $counter = $counter + 1;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $counter }}</th>
                                            <td>{{ $expense->date }}</td>
                                            <td>{{ $expense->description }}</td>
                                            <td>{{ $expense->amount }}</td>
                                            {{-- <td>{{ $expense->myAccountBalance }}</td> --}}
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
