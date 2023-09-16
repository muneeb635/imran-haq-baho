@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="container">
                        <div class="container">
                            <h3 class="py-3 text-center">{{ $customer->name }} </h3>
                        </div>
                        <h2 class="py-3 text-center">Send Money</h2>
                        <form action="{{ route('transaction.customer.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $customer->id }}">
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Date</span>
                                <input name="date" type="date" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" {{ old('date') }}>
                            </div>
                            @error('date')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Send Money</span>
                                <input name="deposit" type="numeric" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" {{ old('deposit') }}>
                            </div>
                            @error('deposit')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="container mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Receive Money</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
