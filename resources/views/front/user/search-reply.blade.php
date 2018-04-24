

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


