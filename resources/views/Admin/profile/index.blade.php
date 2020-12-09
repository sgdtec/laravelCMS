@extends('adminlte::page')

@section('title', 'Meu perfil')

@section('content_header')
    <h1>Meu Perfil</h1>
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

@if(session('warning'))
    <div class="alert alert-success">
        {{session('warning')}}
    </div>
@endif

<div class="card">
<div class="card-body">
    <form action="{{route('profile.save')}}" method="POST">
        @method('PUT')
        @csrf
        <div class="box-body">
            <div class="form-group">
                <label class="col-form-label">Nome Completo</label>
                <input type="text" name="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Nome Completo">
            </div>

            <div class="form-group">
                <label class="col-form-label">E-mail</label>
                <input type="email" name="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" placeholder="Seu melhor E-mail">
            </div>

            <div class="form-group">
                <label class="col-form-label">Nova Senha</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Informe a senha">
            </div>

            <div class="form-group">
                <label class="col-form-label">Confirma Senha</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirme sua senha">
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
</div>
@endsection