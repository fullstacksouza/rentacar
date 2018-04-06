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
        
       $s = $search->create($request->all());
       $id = $s->id;
       
       return redirect("/admin/search/$id/questions/create")->with(['id',$id]);

       //return view('dashboard/searches/question-search',compact('id'));

    }

    public function addQuestions(Request $request)
    {
        $pesquisa = $request->all();
        dd($pesquisa);
       // return response()->json(['pesquisa'=>$pesquisa]);
       return redirect("create/search");    
    }
}
