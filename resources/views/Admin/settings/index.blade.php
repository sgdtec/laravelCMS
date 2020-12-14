@extends('adminlte::page')

@section('title', 'Configurações')

@section('content_header')
    <nav class="card">
        <div class="card-body">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/painel">Home</a></li>
            <li class="breadcrumb-item active">Configurações</li>
            </ol>
        </div>
    </nav>    
@endsection
    
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Configurações</h4>
        </div>
        <div class="card-body">
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

             <form action="{{route('settings.save')}}" method="post" class="form-horizontal">
                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Titulo do Site</label>
                    <div class="col-sm-10">
                    <input type="text" name="title" value="{{$settings['titulo']}}" class="form-control" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">SubTitulo</label>
                    <div class="col-sm-10">
                      <input type="text" name="subtitle" value="{{$settings['subtitulo']}}" class="form-control" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">E-mail Contato</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{$settings['email']}}" class="form-control" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cor de fundo</label>
                    <div class="col-sm-10">
                        <input type="color" name="bgcolor" value="{{$settings['bgcolor']}}" class="form-control" style="width: 70px;" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cor de Texto</label>
                    <div class="col-sm-10">
                        <input type="color" name="textcolor" value="{{$settings['textcolor']}}" class="form-control" style="width: 70px;" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit"  value="Salvar" class="btn btn-sm btn-success" >
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
    