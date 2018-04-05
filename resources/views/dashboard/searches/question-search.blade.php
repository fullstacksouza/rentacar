@extends('adminlte::page')

@section('title', 'Realiza Rent a car | Cadastrar Pesquisa')

@section('content_header')
    <h1>Criar Perguntas</h1>
@stop

@section('content')

@include('dashboard/alerts/alerts')
<!-- Horizontal Form -->
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Vamos Criar as perguntas</h3>
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
  
            <example></example>

          </div>



      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-default">Cancelar</button>
        <button type="submit" class="btn btn-info pull-right">Prosseguir</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
  <!-- /.box -->

  

<script src="{{asset('js/app.js')}}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

    <script> $(function(){
      $('.clickable').on('click',function(){
          var effect = $(this).data('effect');
              $(this).closest('.panel')[effect]();
        })
      })
      </script>
@stop

 
 