@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
{{--alertas --}}
@include('dashboard/alerts/alerts')
    <h1>Lista de Pesquisas</h1>
@stop

@section('css')

@stop
@section('content')

<div class="box">
    <div class="box-header">
      <h3 class="box-title">Tabela de Pesquisa direcionadas para você</h3>
    </div>

    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Titulo</th>
          <th>Data de Inicio</th>
          <th>Prazo</th>
          <th>Acções</th>
        </tr>
        </thead>
        <tbody>
         @forelse ($searches as $search)
        <tr>

          <td>{{$search->title}}</td>
          <td>{{date('d/m/y',strtotime($search->date_start))}}</td>
          <td>
              @if(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($search->date_end)) > 0)

              {{\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($search->date_end))}} dias
            @else
            {{\Carbon\Carbon::now()->diffInHours(\Carbon\Carbon::parse($search->date_end))}} Horas
            @endif
            </td>
          <td>
              <a href="#" class="btn btn-primary">Responder</a>
          </td>

        </tr>
        @empty
        Sem Registros
        @endforelse

        </tbody>
        <tfoot>
        <tr>
          <th>Titulo</th>
          <th>Data de Inicio</th>
          <th>Prazo</th>
          <th>Ações</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

@stop

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

