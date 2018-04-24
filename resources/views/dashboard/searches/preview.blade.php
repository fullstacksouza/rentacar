

@extends('adminlte::page')
@section('title', 'Realiza Rent a car | Cadastrar Pesquisa')

@section('content_header')
    <h1 class="text-center"> {{$search->title}}</h1>

@stop

@section('content')

@include('dashboard/alerts/alerts')
<!-- Horizontal Form -->
{{Form::open(array('route' => array('search.publish', $search->id),'id'=>'search_publish'))}}
{{csrf_field()}}
{{Form::close()}}
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Informe os dados da Pesquisa a ser cadastrado</h3>
    <!-- /.box-header -->
    <!-- form start -->
    <!-- PERGUNTAS-->
    @forelse($search->questions as $question)
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
                            <label>                               <input type="radio" name="optionsRadios" id="optionsRadios1" value="0" checked>
 Nenhuma das opçoes acima?</label>
                                <textarea type="text" class="form-control" id="inputEmail3"  name="text_answer"></textarea>


             </div>

             @endif
        @endforeach
        </div>

    @empty

    @endforelse
    <div class="box-footer">

        <button type="submit" class="btn btn-default">Cancelar</button>
        <button type="submit"  id="publishSearch"  class ="btn btn-info pull-right">Publicar Pesquisa</button>
      </div>
    <!--final de perguntas>


<script src="{{asset('js/app.js')}}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(document).ready(function(){

        $("#publishSearch").click(function(){


            $("#search_publish").submit();
        })
    })
</script>
@stop


