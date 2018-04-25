

@extends('adminlte::page')
@section('title', 'Realiza Rent a car | Responder Pesquisa')

@section('content_header')
    <h1 class="text-center"> {{$search->title}}</h1>

@stop

@section('content')

@include('dashboard/alerts/alerts')
<!-- Horizontal Form -->
<div class="box box-info">
    <!-- /.box-header -->
    <!-- form start -->
    <!-- PERGUNTAS-->
    <div id="app">

        <search>

        </search>

    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmação de envio de respostas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja enviar as respostas para essa pesquisa?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button"  class="btn btn-primary">Enviar Respostas</button>
      </div>
    </div>
  </div>
</div>
    <!--@forelse($search->questions as $question)
    <div class="panel panel-primary">
      <div class="panel-heading"><h2 class="text-center">{{$question->question}}</h2></div>

        @foreach($question->answerOptions as $asnw)
            @if(strcmp($asnw->option,"text") != 0)


            <div class="form-group">
                    <div class="radio">
                            <label>
                             <input type="radio" name="optionsRadios" id="optionsRadios1" value="{{$asnw->id}}" checked>
                              {{$asnw->option}}
                            </label>
                        </div>
             </div>

             @else
             <div class="form-group">
                <label>
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="0" checked>
                 Nenhuma das opçoes acima?
                </label>
                 <textarea type="text" class="form-control" id="inputEmail3"  name="text_answer"></textarea>
            </div>

             @endif
        @endforeach
        </div>

    @empty

    @endforelse-->



<script src="{{asset('js/app.js')}}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop


