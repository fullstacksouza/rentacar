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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

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
                {{ Form::label('dob', 'Data de Nascimento',['class'=>"col-sm-2 control-label"]) }}

                <div class="col-sm-10">
                   {{ Form::date('dob',null,['class'=>'form-control','placeholder'=>'Data de Nascimento'])}}
                </div>
         </div>

        <div class="form-group">
                {{ Form::label('rg', 'RG',['class'=>"col-sm-2 control-label"]) }}

                <div class="col-sm-10">
                        {{ Form::text('rg',null,['class'=>'form-control','placeholder'=>'Numero do RG'])}}
                </div>
         </div>

         <div class="form-group">
                {{ Form::label('registration', 'Matrícula',['class'=>"col-sm-2 control-label"]) }}

                <div class="col-sm-10">
                        {{ Form::text('registration',null,['class'=>'form-control','placeholder'=>'Matrícula'])}}
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

                     @if(isset($userEdit->roles[0]))
                      @if($role->id == $userEdit->roles[0]->id)
                  <option value="{{$role->id}}" selected>{{$role->display_name}}</option>
                      @else

                      <option value="{{$role->id}}">{{$role->display_name}}</option>
                      @endif
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

               @if(isset($sector))
                @if($sector == $userEdit->sector)
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
      <a href="{{url('/admin/users/list')}}" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-info pull-right">Atualizar</button>
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
<script>


</script>
@stop
