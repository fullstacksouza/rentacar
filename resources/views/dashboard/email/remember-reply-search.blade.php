<h1>Olá {{$user->name}} </h1>

<p>Verificamos que você ainda não repondeu a pesquisa destinada ao seu setor.</p>
<p>Lembre-se o prazo para responder essa pesquisa é de até {{date('d/m/y',strtotime($search->date_end))}}</p>
<br>
<br>
<h2>Clique aqui para responder a pesquisa:  <a href='{{url("user/searches/$search->id/reply")}}' class="btn btn-primary">Responder Pesquisa</a></h2>