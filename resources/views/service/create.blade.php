@extends('layouts.app')

@section('title', 'Create Service')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Apps /</span> Service
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Create Service</h5>
        <div class="card-body">
            <form action="{{ route('service.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="service_name">Service Name</label>
                            <input type="text" class="form-control @error('service_name') is-invalid @enderror"
                                name="service_name" required value="{{ old('service_name') }}">
                            @error('service_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="service_icon">Service Icon</label>
                            <input type="text" class="form-control @error('service_icon') is-invalid @enderror"
                                name="service_icon" value="{{ old('service_icon') }}">
                            @error('service_icon')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="service_description">Service Description</label>
                            <textarea name="service_description" class="form-control @error('service_description') is-invalid @enderror"
                                id="" cols="30" rows="10">{{ old('service_description') }}</textarea>
                            @error('service_description')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
