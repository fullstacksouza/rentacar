<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Admin\Search;
class SearchController extends Controller
{
    public function create()
    {
        return view('dashboard/searches/create');
    }

    public function store(SearchRequest $request,Search $search)
    {
        $search->create($request->all());
        return redirect()->back()->with('info','Pesquisa Cadastrada com Sucesso!');
    }
}
