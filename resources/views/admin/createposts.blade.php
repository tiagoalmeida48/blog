@extends('layouts.app')

@section('content')
<div class="container pt-2">
    <div class="card shadow p-3">
        <div class="card-body">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="card-title text-center">Cadastrar Post</h2>
                <div class="form-group row">
                    <label for="title" class="form-label">Titulo</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{old('title')}}" name="title">
                    </div>
                    @error('title')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea name="description" cols="30" rows="10" class="textArea">{{old('description')}}</textarea>
                    @error('description')
                        <div class="alert alert-danger mt-3" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div><br>
                <div class="form-group row">
                    <label>
                        <input type="file" name="image_path" id="image_path" class="text-uppercase btn btn-light fileButton">
                    </label>
                    @error('image_path')
                        <div class="alert alert-danger mt-3" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div><br>

                <button type="submit" class="btn btn-dark">Salvar Post</button>
            </form>
        </div>
    </div>
</div>
@endsection
