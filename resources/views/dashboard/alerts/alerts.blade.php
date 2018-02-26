 @if(session()->has('unauthorized'))
      <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i>Acesso Negado!</h4>
                {{session('unauthorized')}}
              </div>
    
  @else
  @if(session()->has('info'))
  <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-info"></i>Sucesso</h4>
      {{session('info')}}
    </div>
    @endif
  @endif