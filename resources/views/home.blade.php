@extends('layouts.app')

@section('content')
<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-8">
            @foreach ($posts as $Posts)
                <div class="card mb-3 shadow p-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{ asset("images/$Posts->image_path") }}" alt="{{ $Posts->title }}" class="imagesPost mt-3" />
                            </div>
                            <div class="col-9">
                                <h3>{{ $Posts->title }}</h3>
                                <span class="text-secondary">Escrito por <b><i>{{ $Posts->user->name }}</i></b> em {{ $Posts->created_at->format('d/m/Y') }}</span><br><br>
                                <span>{{ substr($Posts->description, 0, 200) }}...</span><br>
                                <a href="{{ route('show', $Posts->id) }}" class="mt-3 btn btn-dark">Leia Mais...</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-4">
            @include('layouts.sidebar')
        </div>
    </div>
</div>
@endsection
