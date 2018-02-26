@extends('adminlte::page')

@section('title', 'Realiza Rent a car | Cadastrar Usuário')

@section('content_header')
    <h1>Criar Usuário</h1>
@stop

@section('content')
<!-- Horizontal Form -->
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Informe os dados do usuario a ser cadastrado</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->

   
  <form class="form-horizontal" action="{{url('admin/users/create')}}" method="post">

    {{csrf_field()}}
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nome Completo</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Nome Completo" name="name">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
          </div>
        </div>
    
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Perfil</label>

          <div class="col-sm-10">

            <select  class="form-control" name="role">
             
              @forelse($roles as $role)
            <option value="{{$role->id}}">{{$role->display_name}}</option>
            @empty
              <option value="0"></option>
              @endforelse
              
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Setor</label>

          <div class="col-sm-10">
            <select class="form-control"  name="sector">

              @forelse($sectors as $sector)
            <option value="{{$sector->id}}">{{$sector->name}}</option>
            @empty
              <option value="0"></option>
            @endforelse
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label" name="">Senha</label>

          <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword3" placeholder="Senha" name="password">
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

 
 