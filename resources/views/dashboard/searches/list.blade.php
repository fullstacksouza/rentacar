@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
{{--alertas --}}
@include('dashboard/alerts/alerts')
    <h1>Lista de Pesquisas</h1>
@stop

@section('css')

@stop
@section('content')

{!! Form::open(['url'=>'#','id'=>'delete-form']) !!}
{!! Form::close() !!}
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Tabela de  Pesquisas Cadastradas</h3>
    </div>

    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Titulo</th>
          <th>Data de Inicio</th>
          <th>Data de Expiração</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
        </thead>
        <tbody>
         @forelse ($searches as $search)
        <tr>

          <td>{{$search->title}}</td>
          <td>{{date('d/m/Y',strtotime($search->date_start))  }}</td>
          <td>{{date('d/m/y',strtotime($search->date_end))}}</td>
          <td>{{$search->getStatus($search->status)}}</td>
          <td>
              @if($search->status !== 0)
          <a class='btn btn-primary' href='{{url("admin/search/$search->id/details")}}'>Vizualizar Relatório</a>
            @else
            <a class='btn btn-primary' href='{{url("admin/search/$search->id/preview")}}'>Vizualizar Pesquisa</a>
          @endif

           @if($search->status == 0)
          <a class='btn btn-warning' href='{{url("admin/searches/$search->id/edit")}}'>Editar</a>
          @endif
          <a class='delete btn btn-danger'onclick="confirmDelete({{$search->id}})">Excluir</a>

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
          <th>Status</th>
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
        $("#delete-form").attr('action',url+'/admin/searches/'+id+'/delete');
        var $form = $("#delete-form");
        $('#confirm').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            $("#delete-form").submit()
        });
   }
      </script>

@stop
