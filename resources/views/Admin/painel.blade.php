@extends('adminlte::page')

@section('title', 'DashBoard')

@section('content_header') 
    <div class="row">
        <div class="col-md-6">
            <h1>Dashboard</h1>
        </div>

        <div class="col-md-6">
            <form  method="get">            
                <select onChange="this.form.submit()" name="interval" class="float-md-right">
                    <option {{$dateInterVal == 30 ? 'selected="selected"' : ''}}  value="30">Últimos 30 dias</option>
                    <option {{$dateInterVal == 60 ? 'selected="selected"' : ''}} value="60">Últimos 60 dias</option>
                    <option {{$dateInterVal == 90 ? 'selected="selected"' : ''}} value="90">Últimos 90 dias</option>
                    <option {{$dateInterVal == 120 ? 'selected="selected"' : ''}} value="120">Últimos 120 dias</option>
                </select>
            </form>
        </div>
    </div>   
@endsection
    
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$userCount}}</h3>
                    <p>Usuários</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-user"></i>
                </div>
            </div> 
        </div>

        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$onLineCount}}</h3>
                    <p>Usuários onLine</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-heart"></i>
                </div>
            </div> 
        </div>

        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$visitsCount}}</h3>
                    <p>Acessos</p>                     
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-eye"></i>
                </div>
            </div> 
        </div>                

        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$pageCount}}</h3>
                    <p>Páginas</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-sticky-note"></i>
                </div>
            </div> 
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Páginas mais visitadas</h3>
                </div>
                <div class="card-body">
                    <canvas id="pagePie"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Páginas mais visitadas</h3>
                </div>
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function(){
            let ctx = document.getElementById('pagePie').getContext('2d');
            window.pagePie = new Chart(ctx, {
                type:'doughnut',
                data:{
                    datasets:[{
                        data:{{ $pageValues }},
                        backgroundColor : [
                            '#f56954',
                            '#d2d6de',
                            '#00a65a',
                            '#f39c12',
                            '#00c0ef',
                            '#3c8dbc',
                            
                        ]
                    }],
                    labels:{!! $pageLabels !!}
                },
                options: {
                    responsive:true,
                    legend: {
                        display:false
                    }
                }
            })
        }
    </script>

@endsection