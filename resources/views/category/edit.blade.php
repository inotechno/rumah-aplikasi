@extends('layouts.app')
@section('title', 'Edit Category')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Blog /</span> Categories
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Edit Category</h5>
        <div class="card-body">
            <form action="{{ route('category.update', $category->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                name="category_name" required value="{{ $category->category_name }}">
                            @error('category_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="category_icon">Category Icon</label>
                            <input type="text" class="form-control @error('category_icon') is-invalid @enderror"
                                name="category_icon" value="{{ $category->category_icon }}">
                            @error('category_icon')
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
