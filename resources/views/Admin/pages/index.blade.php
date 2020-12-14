@extends('adminlte::page')

@section('title', 'Páginas')

@section('content_header')
    <nav class="card">
        <div class="card-body">
            <h1 class="icon-home pb-0">
                Páginas
            </h1>
        </div>
        <div class="card-body">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/painel">Home</a></li>
            <li class="breadcrumb-item active">Minhas Páginas</li>
            </ol>
        </div>
    </nav>
@endsection

@section('content')    
    <div class="card">
        <div class="card-header">
            <a href="{{route('pages.create')}}" class="btn btn-sm btn-success float-right">Nova Página</a>
        </div>
        <div class="card-body"> 
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">#ID</th>
                        <th>Titulo</th>
                        <th width="200">Ações</th>
                    </tr>  
               </thead>
               <tbody>               
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{$page->id}}</td>
                            <td>{{$page->title}}</td>
                            <td>
                                <a href="" target="_blank" class="btn btn-sm btn-warning">Ver</a>
                                <a href="{{route('pages.edit', ['page' => $page->id])}}" class="btn btn-sm btn-info">Editar</a>
                                    <form class="d-inline" method="POST" action="{{route('pages.destroy', ['page' => $page->id])}}" onsubmit="return confirm('Deseja excluir')">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger">Excluir</button>
                                    </form> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$pages->links()}}
        </div>
    </div>
@endsection