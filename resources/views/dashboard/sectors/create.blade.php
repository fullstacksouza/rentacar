@extends('adminlte::page')

@section('title', 'Realiza Rent a car | Cadastrar Usuário')

@section('content_header')
    <h1>Criar Setor</h1>
@stop

@section('content')
@include('dashboard/alerts/alerts')
<!-- Horizontal Form -->
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Informe os dados do setor a ser cadastrado</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->

   
  <form class="form-horizontal" action="{{url('admin/sectors/create')}}" method="post">

    {{csrf_field()}}
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>

          <div class="col-sm-10">
            <input type="text" class="form-control"  placeholder="Nome do Setor" name="name">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Email do(a) responsavel</label>

          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" placeholder="Email do(a) Responsável pelo setor" name="responsible_email">
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-default">Cancelar</button>
        <button type="submit" class="btn btn-info pull-right">Cadastrar</button>
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
    <script> console.log('Hi!'); </script>
@stop

 
 