<h1>Olá {{$user->name}} </h1>

<p>Seu setor acaba de ser selecionado para responder uma pesquisa de clima organizacional.</p>
<p>Clique <a href='{{config("app.url")."/user/search/$search->id/reply"}}'>aqui</a></p>  para responder a pesquisa  