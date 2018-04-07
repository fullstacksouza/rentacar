<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Admin\Search;
use App\Admin\Question;
use App\Admin\AnswerOption;
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
                    //pecorrendo array de opçoes de respostas
                    foreach($p['answer'] as $answ)
                    {
                        $answer = $answOp->create([
                            'question_id' => $question->id,
                            'option' => $answ['op']
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
        
        foreach($search->questions as $question)
        {
            print_r($question->question);
            
            foreach($question->answerOptions as $asnp)
            {
                print_r($asnp->option);
            }
        }
        return view('dashboard/searches/preview',compact('search'));
    }   
}
