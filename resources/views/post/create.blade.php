@extends('layouts.app')

@section('title', 'Create Post')
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
        <span class="text-muted fw-light">Blog /</span> Posts
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Create Post</h5>
        <div class="card-body">
            <form action="{{ route('post.store') }}" method="POST" class="needs-validation" novalidate
                enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md">
                        <input type="file" class="dropify" name="img_thumbnail" data-height="250">
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
                                required value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="" class="form-control select2">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>

                            @error('category_id')
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
                                id="" cols="30" rows="5">{{ old('description_excerpt') }}</textarea>
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
                                cols="30" rows="5">{{ old('description') }}</textarea>
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
                            <label for="taggable">Tags</label>
                            <select name="tags[]"
                                class="form-control select2 select2-hidden-accessible @error('tags') is-invalid @enderror"
                                multiple="" data-placeholder="Select a Tag" style="width: 100%;" tabindex="-1"
                                aria-hidden="true">
                                <option></option>
                            </select>
                            @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            {{-- <select name="taggable" id="" class="form-control select2-multiple">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select> --}}
                            {{-- <input id="taggable" name="taggable" class="form-control tagify" placeholder="Select Tags"
                                tags="">

                            @error('taggable')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror --}}
                        </div>

                    </div>

                    <div class="col-md">
                        <div class="form-group">
                            <label for="status_post">Status Post</label>
                            <select name="status_post" id="" class="form-control select2">
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                            </select>

                            @error('status_post')
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
    <script src="{{ asset('vendor/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/libs/select2/select2.js') }}"></script>

    <script>
        $(function() {
            getTags();

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

            function getTags() {
                var select = $('[name="tags[]"]');

                $.ajax({
                    type: "get",
                    url: "{{ route('tags.getall') }}",
                    dataType: "JSON",
                    success: function(response) {
                        var html = '';
                        $.each(response, function(i, v) {
                            html += '<option value="' + v.id + '">' + v.name + '</option>';
                        });

                        select.html(html);
                        // console.log(response);
                    }
                });

                return false;
            }

            $('.select2').select2();
        });
    </script>
@endsection
