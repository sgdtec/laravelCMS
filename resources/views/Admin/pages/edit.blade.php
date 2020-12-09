@extends('adminlte::page')

@section('title', 'Alterar Página')

@section('content_header')
    <h1>Editar Página</h1>
@endsection

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <h5><i class="icon fas fa-ban"></i>Alerta!</h5>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>    
            @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{route('pages.update', ['page' => $page->id])}}" method="post">
                @method('PUT')
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-form-label">Nome Página</label>
                        <input type="text" name="title" value="{{$page->title}}" class="form-control @error('title') is-invalid @enderror">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Conteudo</label>
                        <textarea name="body" class="form-control">{{$page->body}}</textarea>                        
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection