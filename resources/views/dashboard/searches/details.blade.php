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
              <h3 class="box-title">Lista de Usuarios que ainda não responderam
              </h3>
              <a class='pull-right btn btn-primary' data-toggle="modal" data-id="1" data-token="{{ csrf_token() }}" data-target="#modal-default">Enviar notificação por email</a>

            </div>

            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Setor</th>
                    </tr>
                    </thead>
                    <tbody>
                      @forelse($userDontReply as $userDont)
                    <tr>

                      <td>{{$userDont->name}}</td>
                      <td>{{$userDont->sector->name}}</td>
                      <td>


                      </td>
                    </tr>
                    @empty

                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Notificado</th>

                    </tr>
                    </tfoot>
                  </table>

            </div>
            <!-- /.box-body -->
          </div>
          @php
            $i = 0;
          @endphp
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Respostas campo aberto</h3>
            </div>
            <div class="box-body">
              @foreach($textAnswers as $textAnswer)
                    @foreach($textAnswer as $t)

                      <h2 class="text-center">{{$questionsArray[0]}}</h2>
            <p class="text-center">{{$t->answer}} - <small>Usuario</small></p>
                    @endforeach




                    @endforeach

            </div>
            <!-- /.box-body -->
          </div>

          <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Ações tomadas após realização da pesquisa</h3>
              </div>
              <div class="box-body">
                <p>Após analise da pesquisa, foi tomada a ação de ........</p>

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