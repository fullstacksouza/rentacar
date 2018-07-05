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
  {{config('app.url')." ".url('')}}
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
        <h3 class="box-title text-center">RELATORIO DA ULTIMA PESQUISA REALIZADA</h3>
        <hr>

        <div class="col-md-7">
        <!-- AREA CHART -->
      @if(isset($search))
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
            <h2 class="text-center">{{$questionsArray[$i]}}</h2>
                  @foreach($textAnswer as $t)


                    <p class="text-center">{{$t->answer}} - <small>{{$userObj->find($t->user_id)->name}}</small></p>
                  @endforeach



              @php
              $i++;
              @endphp
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
        <!-- /.col (LEFT) -->

        <!-- /.col (RIGHT) -->
        @endrole
@endif
      </div>
      <!-- /.row -->

@stop


@section('js')
<script>
   $(function(){
      $("#action_register_button").click(function(){
       $("#action_register").submit();
      })
    })
</script>
{!! Charts::scripts() !!}
@if(isset($charts))
@foreach($charts as $ch)
{!! $ch->script() !!}
@endforeach
@endif

@isset($chart)
{!!$chart->script()!!}
@endisset
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::render() !!}
@stop