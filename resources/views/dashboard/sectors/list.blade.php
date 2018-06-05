@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
{{--alertas --}}
@include('dashboard/alerts/alerts')
    <h1>Lista de Setores</h1>
@stop

@section('css')

@stop
@section('content')

{!! Form::open(['url'=>'#','id'=>'delete-form']) !!}
{!! Form::close() !!}
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Tabela de  Setores Cadastrados</h3>
    </div>

    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Nome</th>
          <th>Email do responsavel</th>
          <th>Ações</th>
        </tr>
        </thead>
        <tbody>
         @forelse ($sectors as $sector)
        <tr>

          <td>{{$sector->name}}</td>
          <td>{{$sector->responsible_email or 'Não Cadastrado' }}</td>
          <td>
                <a class='btn btn-warning' href='{{url("admin/sectors/$sector->id/edit")}}'>Vizualizar/Editar</a>
          <a class='btn btn-danger' onclick="confirmDelete({{$sector->id}})">Excluir</a>
          </td>
        </tr>
        @empty
        Sem Registros
        @endforelse

        </tbody>
        <tfoot>
        <tr>
          <th>Nome</th>
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


   function confirmDelete(id)
   {
      var url = "{{url('')}}";
        $("#delete-form").attr('action',url+'/admin/sectors/'+id+'/delete');
        var $form = $("#delete-form");
        $('#confirm').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            $("#delete-form").submit()
        });
   }
      </script>

@stop