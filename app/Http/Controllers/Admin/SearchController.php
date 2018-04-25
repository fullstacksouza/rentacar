<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Admin\Search;
use App\Admin\Sector;
use App\Admin\Question;
use App\Admin\AnswerOption;
use App\User;
use Charts;
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

    public function publishSearch(Request $request)
    {
        $search = Search::findOrFail($request->id);

        if($search)
        {
            $search->status = 1;
            $search->save();
            return redirect('/admin/searches/list');
        }
        return redirectr()->back()->with('error','Pesquisa não encontrada');
    }

    public function details(Request $request)
    {
        $userDontReply = 0; //quantidade de usuarios que NÂO responderam a pesquisa
        $userReply     = 0; // //quantidade de usuarios que responderam a pesquisa
        $search        = Search::findOrFail($request->id);
        foreach($search->users as $users)
        {
            $user           = User::find($users->id);
            $searches       = $user->searches()->where('search_id',$request->id)
            ->where('search_status',0)->count();
            $userDontReply += $searches;

            $userReply += $user->searches()->where('search_id',$request->id)
            ->where('search_status',1)->count();

        }

        //gerando grafico fr usuarios que responderam

/*        $chart = Charts::create('pie', 'highcharts')
        ->title('Quantidade de usuarios que responderam')
        ->labels(['Responderam', 'Não responderam'])
        ->values([$userReply,$userDontReply])
        ->dimensions(1000,500)
        ->responsive(true);*/

        $chart = Charts::multi()
            // Setup the chart settings
            ->title("My Cool Chart")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 400) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
            // ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Element 1', [5,20,100])
            ->dataset('Element 2', [15,30,80])
            ->dataset('Element 3', [25,10,40])
            // Setup what the values mean
            ->labels(['One', 'Two', 'Three']);

        $questionsArray = [];
        $answers   = [];
        $count     = [];
        //gerando graficos de respostas para cada pergunta
        foreach($search->questions as $questions)
        {
            $questionsArray[] =$questions;
            foreach($questions->answerOptions as $answerOptions)
            {
                if(strcmp($answerOptions->option,'text')!= 0)
                {
                    $ansOp = AnswerOption::find($answerOptions->id);
                    $answers [] = $answerOptions->option;
                    $count[]= $ansOp->users()->where('answer_id',$answerOptions->id)->count();
                }
            }
        }

        //return response()->json(['opçao'=>$answers,'quantidade'=>$count,$questionsArray]);
         return view('dashboard/searches/details',compact('questionsArray','chart'));
       // return $searchesOfU;

    }

}
