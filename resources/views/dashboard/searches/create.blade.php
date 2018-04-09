@extends('adminlte::page')
@section('css')
<link rel="stylecheet/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
@stop
@section('title', 'Realiza Rent a car | Cadastrar Pesquisa')

@section('content_header')
    <h1>Criar Nova Pesquisa</h1>
@stop

@section('content')

@include('dashboard/alerts/alerts')
<!-- Horizontal Form -->
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Informe os dados da Pesquisa a ser cadastrado</h3>
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


  <form class="form-horizontal" action="{{url('admin/searches/create')}}" method="post">
    
    {{csrf_field()}}
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" placeholder=" Titulo da Pesquisa" name="title">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Data de inicio </label>

          <div class="col-sm-10">
             {{ Form::date('date_start',null,['class'=>'form-control','placeholder'=>'Data de Nascimento'])}}

          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Data de Expiração </label>

          <div class="col-sm-10">
             {{ Form::date('date_end',null,['class'=>'form-control','placeholder'=>'Data de Expiração'])}}
          </div>
        </div>
        
        <div class="form-group">
          <select class="selectpicker" multiple>
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Relish</option>
          </select>

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

  

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

  <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $(".selectpicker").selectpicker();
  });
  </script>
@stop

 
 