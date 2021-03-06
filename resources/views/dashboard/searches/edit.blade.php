@extends('adminlte::page')

@section('title', 'Realiza Rent a car | Cadastrar Pesquisa')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('content_header')
    <h1>Criar Perguntas</h1>

@stop

@section('content')
@include('dashboard/alerts/alerts')
<!-- Horizontal Form -->
<div class="row">

<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Vamos editar a pesquisa</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div id="app">

            <edit-search></edit-search>


          </div>


      </div>




        <!--/span-->

    </div>


  <!-- /.box -->


<script src="{{asset('js/app.js')}}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

    <script>
    $(function(){
       // var location = window.location.pathname;
        let uri = location.pathname.split("/");




    });
     $(function(){

      $('.clickable').on('click',function(){
          var effect = $(this).data('effect');
              $(this).closest('.panel')[effect]();
        })
      })


      </script>


@stop
