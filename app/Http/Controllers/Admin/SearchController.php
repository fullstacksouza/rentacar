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
        if(is_array($pesquisa))
        {
            $i = 0;

            foreach($pesquisa as $p)
            { 
              
                return $p;
             //  print_r($p);
             //pergunta
               // print_r($p[0]['question']);
               //resposta
               // print_r($p[0]['answer'][0]['op']);
                $i++;

            }
        }else
        {
        return "nao e array";
        }
    }
}
