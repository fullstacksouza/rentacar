@extends('adminlte::page')

@section('title', 'Realiza Rent a car | Cadastrar Usuário')

@section('content_header')
    <h1>Editar Usuário</h1>
@stop

@section('content')
@include('dashboard/alerts/alerts')
<!-- Horizontal Form -->
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Informe os dados do usuario a ser atualizado</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->

   
    {{ Form::model($userEdit,['url'=>"admin/users/$userEdit->id/edit",'class'=>'form-horizontal']) }}  

    {{csrf_field()}}
      <div class="box-body">

        <div class="form-group">
            {{ Form::label('name', 'Nome Completo',['class'=>"col-sm-2 control-label"]) }}
            <div class="col-sm-10">
            {{ Form::text('name',null,['class'=>'form-control','readonly'])}}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('email', 'Email',['class'=>"col-sm-2 control-label"]) }}
            <div class="col-sm-10">
            {{ Form::text('email',null,['class'=>'form-control','readonly'])}}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('perfil', 'Perfil',['class'=>"col-sm-2 control-label"]) }}
            <div class="col-sm-10">

            <select  class="form-control" name="role">
             
              @forelse($roles as $role)
                
                @if($role->id == $userEdit->role)
            <option value="{{$role->id}}" selected>{{$role->display_name}}</option>
                @else
                    <option value="{{$role->id}}">{{$role->display_name}}</option>
                @endif
            @empty
              <option value="0"></option>
              @endforelse
              
            </select>
            </div>
        </div>

        
        <div class="form-group">
            {{ Form::label('setor', 'Setor',['class'=>"col-sm-2 control-label"]) }}
            <div class="col-sm-10">
            
            <select  class="form-control" name="sector">
             
              @forelse($sectors as $sector)
              {{$sector}}
               @if(isset($sector))
                @if($sector === $userEdit->sector)
            <option value="{{$sector->id}}" selected>{{$sector->name}}</option>
                @else
                <option value="{{$sector->id}}">{{$sector->name}}</option>
            @endif
                @endif
            @empty
              <option value="0"></option>
              @endforelse
              
            </select>
            </div>
        </div>

        
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label" name="">Senha</label>
  
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPassword3" placeholder="Senha" name="password">
            </div>
          </div>
        
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-default">Cancelar</button>
        <button type="submit" class="btn btn-info pull-right">Cadastrar</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
  <!-- /.box -->

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

 
    