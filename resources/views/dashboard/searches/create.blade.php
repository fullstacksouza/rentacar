@extends('adminlte::page')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.0/css/bootstrap-select.min.css">
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
    {{date('d-m-Y')}}
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
            <label for="inputEmail3" class="col-sm-2 control-label">Setores Destinados</label>
  
            <div class="col-sm-10">
                <select class="form-control selectpicker" name="sector[]" multiple   data-actions-box="true">
                  @foreach($sectors as $sector)
                <option value="{{$sector->id}}">{{$sector->name}}</option>
                    @endforeach
                  </select>
                  
            </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.0/js/i18n/defaults-pt_BR.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.0/js/bootstrap-select.min.js"></script>


<script>
  $('.selectpicker').selectpicker({
    liveSearch:true,
    selectAllText:"Selecionar todos",
    deselectAllText:"Desmarcar todos"
  })
  .on('hidden.bs.select',
        function () {
            $(this).data('selectpicker').$searchbox.val('').trigger('propertychange');
        });

  
</script>
@stop

 
 