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
        return view('dashboard/searches/question-search');
    }

    public function store(SearchRequest $request,Search $search)
    {
       $s = $search->create($request->all());
        $searchId = $s->id;
        return view("dashboard/searches/question-search",compact('searchId'));
    }
}
