@extends('adminlte::page')

@section('title')
@section('css')
{!! Charts::styles() !!}

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@stop
@section('content_header')
{{--alertas --}}
@include('dashboard/alerts/alerts')

<h1>Relatório da pesquisa: {{$search->title}}</h1>
@stop



@section('content')
<div class="row">
        <div class="col-md-7">
          <!-- AREA CHART -->

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Usuarios que responderam</h3>
            </div>
            <div class="box-body text-center">
              <div class="chart text-center">
                  {!!$chart->html()!!}
              </div>
            </div>
            <!-- /.box-body -->
          </div>


          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Respostas campo aberto</h3>
            </div>
            <div class="box-body">
                <h2 class="text-center">Pergunta</h2></h2>
                    <h3 class="text-center">Resposta <small>- Usuario tal</small></h3>

            </div>
            <!-- /.box-body -->
          </div>

        </div>

          <!-- /.box -->

@php
$i = 0
@endphp

<aside role="complementary" class="col-md-5">

          <!-- AREA CHART -->

          @foreach($questionsArray as $question)

          <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="text-center">{{$question}}</h3>

            </div>
            <div class="box-body text-center">

              <div class="chart text-center">
                {!!$charts[$i]->html()!!}
              </div>

              @php
              $i++
              @endphp

            </div>
            <!-- /.box-body -->
          </div>
          @endforeach
  </aside>
</div>
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