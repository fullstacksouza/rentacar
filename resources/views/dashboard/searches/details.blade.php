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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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

          @if(count($userDontReply) > 0)
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Lista de Usuarios que ainda não responderam
              </h3>

            <a href='{{url("admin/search/$search->id/send-notification")}}' class='pull-right btn btn-primary'>Enviar notificação por email</a>

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

                    </tr>

                    @empty

                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Setor</th>


                    </tr>
                    </tfoot>
                  </table>

            </div>
            <!-- /.box-body -->
          </div>

          @endif
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

                @forelse($search->actions as $action)
                <div class="card bg-primary text-white">
                  <div class="card-body">{{$action->action}} - Data: {{date('d/m/y',strtotime($action->created_at))}}</div>
                </div>
              <p></p>
                @empty

                @endforelse

                <button class="btn btn-primary pull-right"  data-toggle="modal" data-target="#myModal">Adicionar Açao</button>

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

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registrar ação tomada após analise da pesquisa</h4>
        </div>
        <div class="modal-body">
          {{Form::open(['url'=>"admin/search/$search->id/action/register",'id'=>'action_register'])}}

            <textarea class="form-control" name="action_register" required></textarea>
          {{Form::close()}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default  pull-left" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary  pull-right" id="action_register_button">Registrar Ação</button>

        </div>
      </div>

    </div>
  </div>
@stop


@section('js')
<!--charts do package-->
<script type="text/javascript" src="https://cdn.rawgit.com/Mikhus/canvas-gauges/gh-pages/download/2.1.2/all/gauge.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.10.1/chartist.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript" src="https://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script type="text/javascript" src="https://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">google.charts.load('current', {'packages':['corechart', 'gauge', 'geochart', 'bar', 'line']})</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/5.0.7/highcharts.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/5.0.7/js/modules/offline-exporting.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highmaps/5.0.7/js/modules/map.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highmaps/5.0.7/js/modules/data.js"></script>
<script type="text/javascript" src="https://code.highcharts.com/mapdata/custom/world.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.6/raphael.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/justgage/1.2.2/justgage.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.6/raphael.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/plottable.js/2.8.0/plottable.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.0.1/progressbar.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/echarts/3.6.2/echarts.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.2/amcharts.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.2/serial.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.2/plugins/export/export.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.2/themes/light.js"></script><script>
    $(function() {
        $('.charts').each(function() {
            var chart = $(this).find('.charts-chart');
            var loader = $(this).find('.charts-loader');
            var time = loader.data('duration');

            if(loader.hasClass('enabled')) {
                chart.css({visibility: 'hidden'});
                loader.fadeIn(350);

                setTimeout(function() {
                    loader.fadeOut(350, function() {
                        chart.css({opacity: 0, visibility: 'visible'}).animate({opacity: 1}, 350);
                    });
                }, time)
            }
        });
    })

    $(function(){
      $("#action_register_button").click(function(){
       $("#action_register").submit();
      })
    })
</script>
<!-- package-->
        {!! $chart->script() !!}

        @foreach($charts as $ch)
        {!! $ch->script() !!}
        @endforeach

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
                    "pageLength": 2,
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