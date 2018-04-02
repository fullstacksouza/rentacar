@extends('adminlte::page')

@section('title', 'Realiza Rent a car | Cadastrar Usuário')

@section('content_header')
    <h1>Alterar Senha</h1>
@stop

@section('content')
@include('dashboard/alerts/alerts')
<!-- Horizontal Form -->
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Altere sua senha no formulário abaixo</h3>
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

  <form class="form-horizontal" action="{{url('admin/users/change-pass')}}" method="post">

    {{csrf_field()}}
      <div class="box-body">
          

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nova Senha </label>

          <div class="col-sm-10">
            <input type="password" class="form-control" id="inputEmail3" placeholder="Nova Senha" name="new_pass">
          </div>
        </div>


        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Confirmação de Nova Senha </label>

          <div class="col-sm-10">
            <input type="password" class="form-control" id="inputEmail3" placeholder="Repita a nova senha" name="new_pass_confirmation">
          </div>
          
        </div>


      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-default">Atualizar</button>
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

@stop

 
 