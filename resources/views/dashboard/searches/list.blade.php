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

    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Titulo</th>
          <th>Data de Inicio</th>
          <th>Data de Expiração</th>
          <th>Ações</th>
        </tr>
        </thead>
        <tbody>
         @forelse ($searches as $search)
        <tr>
       
          <td>{{$search->title}}</td>
          <td>{{date('d/m/Y',strtotime($search->date_start))  }}</td>
          <td>{{date('d/m/y',strtotime($search->date_end))}}</td>
          <td>
          <a class='btn btn-primary' href='{{url("admin/search/$search->id/preview")}}'>Vizualizar</a>
          <a class='btn btn-warning' href='{{url("admin/users/$search->id/edit")}}'>Editar</a>
          <a class='delete btn btn-danger' data-toggle="modal" data-id="{{ $search->id }}" data-token="{{ csrf_token() }}" data-target="#modal-default">Excluir</a>
        
          </td>
        </tr>
        @empty
        Sem Registros
        @endforelse
        
        </tbody>
        <tfoot>
        <tr>
          <th>Titulo</th>
          <th>Data de Inicio</th>
          <th>Data de Expiração</th>
          <th>Ações</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Atenção!</h4>
        </div>
        <div class="modal-body">
          <p>Deseja realmente excluir o usuario selecionado?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button  type="button" id='confirm-delete' class="btn btn-primary">Confirmar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
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
        });
        var id;
        var token;
        $(".delete").click(function(){
         id= $(this).data('id');
         token = $(this).data('token');
        });


          $("#confirm-delete").click(function(){
            alert(id);
            $.ajax({
            url:"user/"+id+"/delete",
            type:"PUT",
            //dataType: "JSON",
            data :{
              "id":id,
              "_token":token,
            },
            success: function(data){
              console.log(data);
            },
            error: function(request, status, erro)
            {
              alert("Problema ocorrido: " + status + "\nDescição: " + erro);
            //Abaixo está listando os header do conteudo que você requisitou, só para confirmar se você setou os header e dataType corretos
                   
            }


          });
          });
      </script>

@stop