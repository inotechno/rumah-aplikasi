@extends('layouts.app')

@section('title', 'Edit Portfolio')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/select2/select2.css') }}" />

    <style>
        .note-editor .dropdown-toggle::after {
            all: unset;
        }

        .note-editor .note-dropdown-menu {
            box-sizing: content-box;
        }

        .note-editor .note-modal-footer {
            box-sizing: content-box;
        }
    </style>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Apps /</span> Portfolio
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Create Portfolio</h5>
        <div class="card-body">
            <form action="{{ route('portfolio.edit', $portfolio->id) }}" method="POST" class="needs-validation" novalidate
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md">
                        <input type="hidden" name="img_thumbnail_old" value="{{ $portfolio->img_thumbnail }}">
                        <input type="file" class="dropify" name="img_thumbnail"
                            data-default-file="{{ asset('storage/portfolios/' . $portfolio->img_thumbnail) }}"
                            data-height="250">
                        @error('img_thumbnail')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                required value="{{ $portfolio->title }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="service_id">Service Type</label>
                            <select name="service_id" id="" class="form-control select2">
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" @if ($service->id == $portfolio->service_id) selected @endif>
                                        {{ $service->service_name }}</option>
                                @endforeach
                            </select>

                            @error('service_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="service_name">Description Excerpt</label>
                            <textarea name="description_excerpt" class="form-control @error('description_excerpt') is-invalid @enderror"
                                id="" cols="30" rows="5">{{ $portfolio->description_excerpt }}</textarea>
                            @error('description_excerpt')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="service_name">Description</label>
                            <textarea name="description" class="form-control text-editor @error('description') is-invalid @enderror" id=""
                                cols="30" rows="5">{{ $portfolio->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="url_portfolio">Url Portfolio</label>
                            <input type="url" class="form-control @error('url_portfolio') is-invalid @enderror"
                                name="url_portfolio" value="{{ $portfolio->url_portfolio }}">
                            @error('url_portfolio')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="status_portfolio">Status Portfolio</label>
                            <select name="status_portfolio" id="" class="form-control select2">
                                <option value="release" @if ($portfolio->status_portfolio == 'release') selected @endif>Release</option>
                                <option value="beta" @if ($portfolio->status_portfolio == 'beta') selected @endif>Beta</option>
                                <option value="development" @if ($portfolio->status_portfolio == 'development') selected @endif>Development
                                </option>
                            </select>

                            @error('status_portfolio')
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

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('vendor/libs/select2/select2.js') }}"></script>

    <script src="{{ asset('vendor/libs/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(function() {

            // CKEDITOR.replace('description', {
            //     filebrowserImageBrowseUrl: '/filemanager?type=Images',
            //     filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
            //     filebrowserBrowseUrl: '/filemanager?type=Files',
            //     filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
            // });

            CKEDITOR.replace('description', {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Max Image Size 2MB',
                    'replace': 'Max Image Size 2MB',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });

            $('.select2').select2();
        });
    </script>
@endsection
