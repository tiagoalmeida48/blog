@extends('layouts.app')

@section('content')
<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-8">
            <div class="card mb-3 shadow p-3">
                <div class="card-body">
                    <div class="row">
                        <img src="{{ asset("images/$post->image_path") }}" alt="{{ $post->title }}" class="imageViewPost m-0 p-0" />
                        <h3 class="mt-5">{{ $post->title }}</h3>
                        <span class="text-secondary mb-5">Escrito por <b><i>{{ $post->user->name }}</i></b> em {{ $post->created_at->format('d/m/Y') }}</span><br>
                        <span>{{ $post->description }}</span><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            @include('layouts.sidebar')
        </div>
    </div>
</div>
@endsection
