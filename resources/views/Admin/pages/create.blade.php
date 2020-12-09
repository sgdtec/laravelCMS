@extends('adminlte::page')

@section('title', 'Nova Página')

@section('content_header')
    <h1>Nova Página</h1>
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
            <form action="{{route('pages.store')}}" method="post">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-form-label">Nome Página</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" placeholder="Nome da Página">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Conteudo</label>
                        <textarea name="body" class="form-control">{{old('email')}}</textarea>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Criar</button>
                </div>
            </form>
        </div>
    </div>
@endsection