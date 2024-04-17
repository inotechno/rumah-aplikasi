@extends('layouts.app')
@section('title', 'Detail Message')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Message /</span> Detail Message
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Detail Message</h5>
        <div class="card-body">
            <form action="{{ route('message.reply', $message->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row mb-2">
                    <div class="col-md">
                        <div class="form-group mb-1">
                            <label for="no_antrian">No Antrian</label>
                            <input type="text" readonly class="form-control @error('no_antrian') is-invalid @enderror"
                                name="no_antrian" required value="{{ $message->no_antrian }}">
                        </div>

                    </div>

                    <div class="col-md">
                        <div class="form-group mb-1">
                            <label for="name">Name</label>
                            <input type="text" readonly class="form-control @error('name') is-invalid @enderror"
                                name="name" required value="{{ $message->name }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md">
                        <div class="form-group mb-1">
                            <label for="email">Email</label>
                            <input type="text" readonly class="form-control @error('email') is-invalid @enderror"
                                name="email" required value="{{ $message->email }}">
                        </div>

                    </div>

                    <div class="col-md">
                        <div class="form-group mb-1">
                            <label for="subject">Subject</label>
                            <input type="text" readonly class="form-control @error('subject') is-invalid @enderror"
                                name="subject" required value="{{ $message->subject }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md">
                        <div class="form-group mb-1">
                            <label for="message">Message</label>
                            <textarea name="message" id="" class="form-control" readonly>{{ $message->message }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md">
                        <div class="form-group mb-1">
                            <label for="message">Reply</label>
                            <textarea name="reply" id="" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md">
                        <button class="btn btn-primary" type="submit">Reply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

@endsection
