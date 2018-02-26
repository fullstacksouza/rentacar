@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
{{--alertas --}}
@include('dashboard/alerts/alerts')
    <h1>Lista de usuários</h1>
@stop

@section('css')

@stop
@section('content')

<div class="box">
    <div class="box-header">
      <h3 class="box-title">Tabela de  Usuários Cadastrados</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Setor</th>
          <th>Email do responsavel</th>
          <th>Ações</th>
        </tr>
        </thead>
        <tbody>
         @forelse ($users as $user)
        <tr>
       
          <td>{{$user->name}}</td>
          <td>{{$user->email  }}</td>
          <td>{{$user->setor->name}}</td>
          <td>{{$user->setor->responsible_email}}</td>
          <td>
          <a   class='btn btn-primary'>Vizualizar</a>
          <a class='btn btn-warning'>Editar</a>
          <a class='btn btn-danger'>Excluir</a>
          </td>
        </tr>
        @empty
        Sem Registros
        @endforelse
        
        </tbody>
        <tfoot>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Setor</th>
          <th>Email do responsavel</th>
          <th>Ações</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@stop

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')

    <script>
        $(function () {
          $('#example1').DataTable({
             "oLanguage": {
                    "sProcessing":   "Processando...",
                    "sLengthMenu":   "Mostrar _MENU_ registros",
                    "sZeroRecords":  "Não foram encontrados resultados",
                    "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                    "sInfoFiltered": "",
                    "sInfoPostFix":  "",
                    "sSearch":       "Buscar:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext":     "Seguinte",
                        "sLast":     "Último"
                    }
                }
          })
        })
      </script>

@stop