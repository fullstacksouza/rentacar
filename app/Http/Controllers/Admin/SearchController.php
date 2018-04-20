<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Admin\Search;
use App\Admin\Sector;
use App\Admin\Question;
use App\Admin\AnswerOption;
class SearchController extends Controller
{
    public function create()
    {
        $sectors = Sector::all();
        return view('dashboard/searches/create',compact('sectors'));
    }

    public function list(Search $search)
    {
        $searches = $search->all();
        return view('dashboard/searches/list',compact('searches'));
    }
    public function test()
    {
        $search = Search::find(43);

        $sectors = $search->sectors;

        foreach($sectors as $sec)
        {
            $sector = $sec->find($sec->id);
            foreach($sector->user as $u)
            {
                $u->searches()->sync($current_search);
            }

            echo $sec->name."<br>";
        }

    }
    public function store(SearchRequest $request,Search $search)
    {

       $s = $search->create($request->all());
       $id = $s->id;
       $current_search = $search->find($id);


       $carbon  = new  \Carbon\Carbon(($current_search->date_end));
       $carbon->addHours(24);

       $current_search->date_end = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$carbon);
       $current_search->save();
       $current_search->sectors()->sync($request->sector);
       //setores para qual a pesquisa foi destinada
       $sectors = $current_search->sectors;
       //direcionar a pesquisa para as pessoas dos setores
       foreach($sectors as $sec)
       {
           $sector = $sec->find($sec->id);
           foreach($sector->user as $u)
           {
               $u->searches()->attach($current_search);
           }

           echo $sec->name."<br>";
       }




       return redirect("/admin/search/$id/questions/create");


    }

    public function addQuestions(Request $request,Question $quest,AnswerOption $answOp)
    {

        $questions = $request->all();
        $perguntas = [];

       // return $questions['search'];
        if(is_array($questions))
        {
            $i = 0;
            //pecorrendo array dos dados enviados pelo vueJs
            foreach($questions['search'] as $p)
            {
                //salvando pergunta
                $question = $quest->create([
                    'search_id' => $request->search_id,
                    'question' => $p['question'],
                    'type' =>1
                ]);
                //criando relacionamento da pergunta com a pesquisa
                $question->search()->associate($request->search_id)->save();


                if(is_array($p['answer']))
                {
                    foreach($p['answer'] as $answ)
                    {
                        $answer = $answOp->create([
                            'question_id' => $question->id,
                            'option' => $answ['op']
                        ]);
                        $answer->question()->associate($question->id)->save();
                    }
                }
                    ///verificando se existe opçao de resposta como campo de texto
                if(isset($p['text_answer']))
                {
                    foreach($p['text_answer'] as $text)
                    {
                        $answer = $answOp->create([
                            'question_id' => $question->id,
                            'option' => 'text'
                        ]);
                        $answer->question()->associate($question->id)->save();

                    }
                }
               // print_r($p['question']);
            }
        }

        return response(['status'=>'success']);
    }

    public function previewSearch(Request $request)
    {
        $search = Search::find($request->id);


        return view('dashboard/searches/preview',compact('search'));
    }
}
