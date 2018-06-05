@extends('adminlte::page')

@section('title')
@section('css')
{!! Charts::styles() !!}

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@stop
@section('content_header')
{{--alertas --}}
@include('dashboard/alerts/alerts')

    <h1>Dashboard</h1>
@stop



@section('content')
<div class="row">
  @role("super-admin")
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                  <h3>{{$totalUsers}}</h3>

                    <p>Total de Usuarios</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                <a href="{{url('admin/users/list')}}" class="small-box-footer">
                  Listar Usuarios <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-red">
                    <div class="inner">
                    <h3>{{$totalSearches}}</h3>

                      <p>Total de Pesquisas Realizadas</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                  <a href="{{url('admin/searches/list')}}" class="small-box-footer">
                      Listar Pesquisas <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>


        </div>
        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ultima Pesquisa Realizada</h3>


            </div>
            <div class="box-body">
              <div class="chart">
                @isset($chart)
                  {!!$chart->html()!!}
                @endisset
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- DONUT CHART -->

          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Total de Pesquisas Realizadas</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">

              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



        </div>
        <!-- /.col (RIGHT) -->
        @endrole

        <h1 class="h1"> Olá {{\Auth::user()->name}}  Verifique se você tem novas pesquisas clicando no menu a esquerda </h1>
      </div>
      <!-- /.row -->

@stop


@section('js')
{!! Charts::scripts() !!}
@isset($chart)
{!!$chart->script()!!}
@endisset
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::render() !!}
@stop