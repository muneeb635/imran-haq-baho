@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="container">
                        <h2 class="py-3 text-center">Add Supplier</h2>
                        <form action="{{ route('supplier.store') }}" method="POST">
                            @csrf
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Supplier Name</span>
                                <input name="name" type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" {{ old('name') }}>
                            </div>
                            @error('name')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Balance</span>
                                <input name="balance" type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" {{ old('balance') }}>
                            </div>
                            @error('balance')
                                <strong><span style="color: red">{{ $message }}</span></strong>
                            @enderror
                            <div class="container mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Add Supplier</button>
                                </div>
                            </div>








                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
