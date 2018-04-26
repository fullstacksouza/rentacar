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
        <div class="col-md-12">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Grafico 1</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body text-center">
              <div class="chart text-center">
                  {!!$chart->html()!!}
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
          <!-- /.box -->

@foreach($questionsArray as $questions)
          <div class="col-md-12">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="text-center">{{$questions->question}}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body text-center">

              <div class="chart text-center">
                 Grafico da{{$questions->question}}
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
@endforeach

@foreach($charts as $ch)
{!!$ch->html()!!}
@endforeach
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

@stop


@section('js')
{!! Charts::scripts() !!}
        {!! $chart->script() !!}

        @foreach($charts as $ch)
        {!! $ch->script() !!}
        @endforeach

        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::render() !!}
@stop