@extends('adminlte::page')

@section('title', 'Realiza Rent a car | Editar Usuario')

@section('content_header')
    <h1>Editar Usuário</h1>
@stop

@section('content')

@include('dashboard/alerts/alerts')
<!-- Horizontal Form -->
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Informe os dados do usuario a ser Atualizado</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::model($user, array('url' => "admin/users/$user->id/edit",'class'=>'form-horizontal')) }}    

    <div class="box-body">
      <div class="form-group">
          {{ Form::label('name', 'Nome Completo',['class'=>'col-sm-2 control-label']) }}
      <div class="col-sm-10">
           
          {{ Form::text('name',$user->name,['class'=>'form-control','readonly']) }}
      </div>
      </div>

      
      <div class="form-group">
          {{ Form::label('email', 'Email',['class'=>'col-sm-2 control-label']) }}
      <div class="col-sm-10">
           
          {{ Form::email('email',$user->email,['class'=>'form-control','readonly']) }}
      </div>
      </div>
      
      <div class="form-group">
          {{ Form::label('profile', 'Perfil',['class'=>'col-sm-2 control-label']) }}
      <div class="col-sm-10">

      <select  class="form-control" name="role" value="{{$userRole or ''}}">
             
              @forelse($roles as $role)
            <option value="{{$role->id}}">{{$role->display_name}}</option>
            @empty
              <option value="0"></option>
              @endforelse
              
            </select>  
         
      </div>
      </div>

      
      <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Setor</label>
        
          <div class="col-sm-10">
            <select name="sector" class="form-control">
              @forelse($sectors as $sector)
                @if($sector->id == $user->setor->id)
              <option value="{{$sector->id}}" selected>{{$sector->name}}</option>
               @else 
                @if($sector->id != $user->setor->id)
               <option value="{{$sector->id}}">{{$sector->name}}</option>
               @endif
               @endif
              @empty

              @endforelse
            </select>
          </div>
        </div>

  
 

  

  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <button type="submit" class="btn btn-default">Cancelar</button>
    
    {{ Form::submit('Atualizar Usuário',['class'=>'btn btn-info pull-right']) }}
  </div>
{{ Form::close() }}

   
    
  </div>
  <!-- /.box -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

 
 