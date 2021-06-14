@extends('layouts.app')

@section('content')
<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-8">
            @if (session('message'))
                <div class="animate__animated animate__bounceInLeft mensagemAlerta alert text-center alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('messageError'))
                <div class="animate__animated animate__bounceInLeft mensagemAlerta alert text-center alert-danger" role="alert">
                    {{ session('messageError') }}
                </div>
            @endif
            <a href="{{  route('post.create') }}" class="btn btn-dark mb-3">Criar Posts</a>
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
                                <a href="{{ route('post.show', $Posts->id) }}" class="mt-3 btn btn-dark">Leia Mais...</a><br>
                                <a href="{{ route('post.edit', $Posts->id) }}"><i class="bi bi-pencil-fill mx-2 my-3 iconeView text-warning" title="Editar"></i></a>
                                <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $Posts->id }}"><i class="bi bi-x-circle mx-2 my-3 iconeView text-danger" title="Deletar"></i></a>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $Posts->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Informação</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Deleja deletar o post <b><u>{{ $Posts->title }}</u></b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                                <form action="{{route('post.destroy', $Posts->id)}}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger">Sim</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-4 viewPostSideBar">
            @include('layouts.sidebar')
        </div>
    </div>
</div>
@endsection
