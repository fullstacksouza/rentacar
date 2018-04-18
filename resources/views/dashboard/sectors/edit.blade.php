@extends('adminlte::page')

@section('title', 'Realiza Rent a car | Cadastrar Usuário')

@section('content_header')
    <h1>Criar Usuário</h1>
@stop

@section('content')
@include('dashboard/alerts/alerts')
<!-- Horizontal Form -->
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Informe os dados do usuario a ser cadastrado</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->

   
    {{ Form::model($sectorEdit,['url'=>"admin/sectors/$sectorEdit->id/edit",'class'=>'form-horizontal']) }}  

    {{csrf_field()}}
      <div class="box-body">

        <div class="form-group">
            {{ Form::label('name', 'Nome',['class'=>"col-sm-2 control-label"]) }}
            <div class="col-sm-10">
            {{ Form::text('name',null,['class'=>'form-control'])}}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('email', 'Email do Responsavel',['class'=>"col-sm-2 control-label"]) }}
            <div class="col-sm-10">
            {{ Form::text('responsible_email',null,['class'=>'form-control'])}}
            </div>
        </div>
        
        
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-default">Cancelar</button>
        <button type="submit" class="btn btn-info pull-right">Atualizar</button>
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

 
    