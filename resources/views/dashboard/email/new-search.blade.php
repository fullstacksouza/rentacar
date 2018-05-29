<h1>Olá {{$user->name}} </h1>

<p>Seu setor acaba de ser selecionado para responder uma pesquisa de clima organizacional</p>
<p>Clique aqui para responder <a href='{{url("user/searches/$search->id/reply")}}' class="btn btn-primary"></a></p>
