@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow" style="border-radius: 12px;">
                <div class="card-header text-center" style="background-color: #AD1457; color: white;">
                    <h3>{{ $announcement->title }}</h3>
                </div>
                <div class="card-body text-center">
                    @if($announcement->image)
                        <img src="{{ asset($announcement->image) }}" alt="Announcement"
                            class="img-fluid rounded mb-4" style="max-height: 400px;">
                    @else
                        <img src="{{ asset('assets/img/default-announcement.png') }}" alt="No Image"
                            class="img-fluid rounded mb-4" style="max-height: 400px;">
                    @endif
                    <p class="text-justify" style="font-size: 18px; line-height: 1.6;">
                        {{ $announcement->message }}
                    </p>
                    <p class="text-muted"><i>Published on: {{ $announcement->created_at->format('M d, Y') }}</i></p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ url('/') }}" class="btn btn-secondary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
