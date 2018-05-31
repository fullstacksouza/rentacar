<h1>Olá {{$user->name}} </h1>

<p>Seu setor acaba de ser selecionado para responder uma pesquisa de clima organizacional.</p>
<p>Clique aqui para responder a pesquisa  <a href='{{url("user/search/$search->id/reply")}}'></a></p>