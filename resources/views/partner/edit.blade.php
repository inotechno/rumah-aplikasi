@extends('layouts.app')

@section('title', 'Edit Partner')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Apps /</span> Partners
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Edit Partner</h5>
        <div class="card-body">
            <form action="{{ route('partner.update', $partner->id) }}" method="POST" class="needs-validation" novalidate
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="col-md">
                                <input type="hidden" name="logo_old" value="{{ $partner->logo }}">

                                <input type="file" class="dropify" name="logo" data-height="250"
                                    data-default-file="{{ asset('storage/partners/' . $partner->logo) }}">
                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="mb-2" for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" required value="{{ $partner->name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="mb-2" for="website_link">Website Link</label>
                                    <input type="url" class="form-control @error('website_link') is-invalid @enderror"
                                        name="website_link" value="{{ $partner->website_link }}">
                                    @error('website_link')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="mb-2" for="facebook_link">Facebook Link</label>
                                    <input type="url" class="form-control @error('facebook_link') is-invalid @enderror"
                                        name="facebook_link" value="{{ $partner->facebook_link }}">
                                    @error('facebook_link')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="mb-2" for="instagram_link">Instagram Link</label>
                                    <input type="url" class="form-control @error('instagram_link') is-invalid @enderror"
                                        name="instagram_link" value="{{ $partner->instagram_link }}">
                                    @error('instagram_link')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="mb-2" for="twitter_link">Twitter Link</label>
                                    <input type="url" class="form-control @error('twitter_link') is-invalid @enderror"
                                        name="twitter_link" value="{{ $partner->twitter_link }}">
                                    @error('twitter_link')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="mb-2" for="linkedin_link">Linkedin Link</label>
                                    <input type="url" class="form-control @error('linkedin_link') is-invalid @enderror"
                                        name="linkedin_link" value="{{ $partner->linkedin_link }}">
                                    @error('linkedin_link')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md text-end">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
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
    <script>
        $(function() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Max Image Size 2MB',
                    'replace': 'Max Image Size 2MB',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });
        });
    </script>
@endsection
