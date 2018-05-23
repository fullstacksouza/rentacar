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

{!! Form::open(['url'=>'#','id'=>'delete-form']) !!}
{!! Form::close() !!}
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Tabela de  Usuários Cadastrados</h3>
    </div>

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
          <td>{{$user->sector->name or 'Não Cadastrado'}}</td>
          <td>{{$user->sector->responsible_email or 'Não Cadastrado' }}</td>
          <td>
          <a   class='btn btn-primary'>Vizualizar</a>
          <a class='btn btn-warning' href='{{url("admin/users/$user->id/edit")}}'>Editar</a>
          <a class='delete btn btn-danger' onclick="confirmDelete({{$user->id}})">Excluir</a>

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


  <div class="modal" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmação de exclusão</h4>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-primary" id="delete-btn">Confirmar</button>
                <button type="button" class="btn  btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
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

   function confirmDelete(id)
   {
      var url = "{{url('')}}";
        $("#delete-form").attr('action',url+'/admin/users/'+id+'/delete');
        var $form = $("#delete-form");
        $('#confirm').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            $("#delete-form").submit()
        });
   }
      </script>

@stop