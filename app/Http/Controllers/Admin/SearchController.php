<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\ActionRegisterRequest;

use App\Admin\Search;
use App\Admin\Sector;
use App\Admin\UserTextAnswer;
use App\Admin\Question;
use App\Admin\AnswerOption;
use App\User;
use Charts;
use DB;
use App\Admin\RegisteredActions;
use App\Jobs\SendMailJob;

class SearchController extends Controller
{
    public function create()
    {
        $sectors = Sector::all();
        return view('dashboard/searches/create', compact('sectors'));
    }


    public function getSearch(Request $request)
    {
      $search = Search::findOrFail($request->id);
      $options = [];
      if($search)
      {
          foreach($search->questions as $question)
          {
              foreach($question->answerOptions as $asnw)
              {
                  $options[] = $asnw;
              }
          }
          return response()->json(['search'=>$search,'questions'=>$search->questions]);

      }
    }
    public function edit(Request $request)
    {
      return view('dashboard/searches/edit');
    }
    public function list(Search $search)
    {
        $searches = $search->all();
        return view('dashboard/searches/list', compact('searches'));
    }

    public function delete(Request $request)
    {
        $search = Search::find($request->id);
        $search->delete();

        return redirect()->back()->with('info', 'Pesquisa excluida com sucesso');
    }
    public function store(SearchRequest $request, Search $search)
    {

        $s = $search->create($request->all());
        $id = $s->id;
        $current_search = $search->find($id);


        $carbon = new \Carbon\Carbon(($current_search->date_end));
        $carbon->addHours(24);

        $current_search->date_end = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $carbon);
        $current_search->save();
        $current_search->sectors()->sync($request->sector);
       //setores para qual a pesquisa foi destinada
        $sectors = $current_search->sectors;
       //direcionar a pesquisa para as pessoas dos setores
        foreach ($sectors as $sec) {
            $sector = $sec->find($sec->id);
            foreach ($sector->user as $u) {
                $u->searches()->attach($current_search);
            }

            echo $sec->name . "<br>";
        }




        return redirect("/admin/search/$id/questions/create");


    }

    public function addQuestions(Request $request, Question $quest, AnswerOption $answOp)
    {

        $questions = $request->all();
        $perguntas = [];

       // return $questions['search'];
        if (is_array($questions)) {
            $i = 0;
            //pecorrendo array dos dados enviados pelo vueJs
            foreach ($questions['search'] as $p) {
                //salvando pergunta
                $question = $quest->create([
                    'search_id' => $request->search_id,
                    'question' => $p['question'],
                    'type' => 1
                ]);
                //criando relacionamento da pergunta com a pesquisa
                $question->search()->associate($request->search_id)->save();


                if (is_array($p['answer'])) {
                    foreach ($p['answer'] as $answ) {
                        $answer = $answOp->create([
                            'question_id' => $question->id,
                            'option' => $answ['op']
                        ]);
                        $answer->question()->associate($question->id)->save();
                    }
                }
                    ///verificando se existe opçao de resposta como campo de texto
                if (isset($p['text_answer'])) {
                    foreach ($p['text_answer'] as $text) {
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

        return response(['status' => 'success']);
    }

    public function update(Request $request, Question $quest, AnswerOption $answOp)
    {
      $questions = $request->all();
      $perguntas = [];

     // return $questions['search'];
      if (is_array($questions)) {
          $i = 0;
          //pecorrendo array dos dados enviados pelo vueJs
          foreach ($questions['search'] as $p) {
              //salvando pergunta
              $question = $quest->find($p['id']);
              if($question)
              {
              $question->question = $p['question'];
              $question->type = 1;
              $question->save();
              $current_search = Search::find($request->search_id);
              $current_search->questions()->save($question);
            }else {
              $question = $quest->create([
                  'search_id' => $request->search_id,
                  'question' => $p['question'],
                  'type' => 1
              ]);
              $question->search()->associate($request->search_id)->save();

            }
              //criando relacionamento da pergunta com a pesquisa
              //$question->search()->associate($request->search_id)->save();


              if (is_array($p['answer'])) {
                  foreach ($p['answer'] as $answ) {
                    if(isset())
                      $answer = $answOp->find($answ['id']);
                      if($answer)
                      {
                      $answer->option = $answ['op'];
                      $answer->save();
                      $question->answerOptions()->save($answer);
                    }else {
                      $answer = $answOp->create([
                          'question_id' => $question->id,
                          'option' => $answ['op']
                      ]);
                      $answer->question()->associate($question->id)->save();

                    }
                    //  $answer->question()->associate($question->id)->save();
                  }
              }
                  ///verificando se existe opçao de resposta como campo de texto
              if (isset($p['text_answer'])) {
                  foreach ($p['text_answer'] as $text) {
                    $answer = $answOp->find($answ['id']);
                    $answer->option = "text";
                    $answer->save();
                      // $answer = $answOp->create([
                      //     'question_id' => $question->id,
                      //     'option' => 'text'
                      // ]);
                      $question->answerOptions()->save($answer);
                      //$answer->question()->associate($question->id)->save();

                  }
              }
             // print_r($p['question']);
             return "ok";
          }
      }
    }

    public function previewSearch(Request $request)
    {
        $search = Search::find($request->id);


        return view('dashboard/searches/preview', compact('search'));
    }

    public function publishSearch(Request $request)
    {
        $search = Search::findOrFail($request->id);

        if ($search) {
            $search->status = 1;
            $search->save();
            return redirect('/admin/searches/list');
        }
        return redirectr()->back()->with('error', 'Pesquisa não encontrada');
    }

    public function details(Request $request)
    {
        $searches;
        $usersDont = []; //array
        $charts = [];
        $userDontReply = []; //lista  de usuarios que NÂO responderam a pesquisa
        $userReply = 0; // //quantidade de usuarios que responderam a pesquisa
        $search = Search::findOrFail($request->id);
        foreach ($search->users as $users) {
            $user = User::find($users->id);
            $searches = $user->searches()->where('search_id', $request->id)
                ->where('search_status', 0)->get();
            if ($searches->count() > 0) {

                $userDontReply[] = $user;
            }

            $userReply += $user->searches()->where('search_id', $request->id)
                ->where('search_status', 1)->count();

        }


        //gerando grafico fr usuarios que responderam

        $chart = Charts::create('pie', 'highcharts')
            ->title('Quantidade de usuarios que responderam')
            ->labels(['Responderam', 'Não responderam'])
            ->values([$userReply, (count($userDontReply))])
            ->dimensions(1000, 500)
            ->responsive(true);

        $chart1 = Charts::create('pie', 'highcharts')
            ->title('Quantidade de usuarios que responderam 2')
            ->labels(['Responderam', 'Não responderam'])
            ->values([$userReply, $userDontReply])
            ->dimensions(1000, 500)
            ->responsive(true);

        $questionsArray = [];
        $answers = [];
        $count = [];
        $textAnswers = [];
        $i = 0;

        //gerando graficos de respostas para cada pergunta
        foreach ($search->questions as $questions) {

            $questionsArray[] = $questions->question;

            foreach ($questions->answerOptions as $answerOptions) {
                if (strcmp($answerOptions->option, 'text') != 0) {
                    $ansOp = AnswerOption::find($answerOptions->id);
                    $answers[] = $answerOptions->option;
                    $count[] = $ansOp->users()->where('answer_id', $answerOptions->id)->count();
                } else {
                    //quantidade de usuarios que optaram por responder com texto
                    $answers[] = "Campo de texto";
                    $count[] = UserTextAnswer::where('question_id', $questions->id)->count();
                    $textAnswers[] = DB::table('user_text_answers')->where('question_id', $questions->id)->get();
                }



            }

            $charts[] = Charts::create('pie', 'highcharts')
                ->title('Porcentagem de respostas para esta pergunta') //($questionsArray[$i]
                ->labels($answers)
                ->values($count)
                ->dimensions(1000, 500)
                ->responsive(true);
            $answers = null;
            $count = null;
            $i++;
        }

        //return response()->json(['opçao'=>$answers,'quantidade'=>$count,$questionsArray]);
        return view('dashboard/searches/details', compact('questionsArray', 'chart', 'charts', 'fullarray', 'search', 'textAnswers', 'userDontReply', 'question'));
       // return $searchesOfU;

    }

    public function actionRegister(ActionRegisterRequest $request)
    {

        $action = RegisteredActions::create([
            'search_id' => $request->id,
            'action' => $request->action_register,
        ]);
        return redirect()->back()->with('info', 'Ação registrada com sucesso');
    }

    public function sendNotification(Request $request)
    {
        $search = Search::findOrFail($request->id);
        foreach ($search->users as $users) {
            $user = User::find($users->id);

            $searches = $user->searches()->where('search_id', $request->id)
                ->where('search_status', 0)->get();
            if ($searches->count() > 0) {
                if ($user->email != null) {

                    $this->dispatch(new SendMailJob('dashboard/email/remember-reply-search', $user, $search));
                }

            }

        }

        return redirect()->back()->with('info','A notificação esta sendo enviada para os usuarios');
    }

}
