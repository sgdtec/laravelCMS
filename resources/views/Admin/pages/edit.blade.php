@extends('adminlte::page')

@section('title', 'Alterar Página')

@section('content_header')
    <nav class="card">
        <div class="card-body">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Minhas Páginas</a></li>
                <li class="breadcrumb-item active">Alterar Página</li>
            </ol>
        </div>
    </nav>
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
        <div class="card-header">
            <h4>Editar Página</h4>
        </div>
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
                        <textarea name="body" class="form-control bodyField">{{$page->body}}</textarea>                        
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>
       tinymce.init({
            selector:'textarea.bodyField',
            height:400,
            menubar:false,
            plugins:['link', 'table', 'image', 'autoresize', 'lists'],
            toolbar:'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | table | link image | bullist numlist',
            content_css:[
                '{{asset('assets/css/content.css')}}'
            ],
            images_upload_url:'{{route('imageUpload')}}',
            images_upload_credentials:true,
            convert_urls:false
        });
    </script>
@endsection