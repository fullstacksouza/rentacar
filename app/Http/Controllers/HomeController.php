<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\Admin\TypeQuestion;
use DB;
use App\User;
use App\Admin\Search;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //redirecionando usuario para a pagina de  lista de pesquisa caso o mesmo nao possua privilegio de adm
        if (!\Auth::user()->hasRole('super-admin')) {
            return redirect('user/searches');
        }
        $totalSearches = Search::all()->count();
        $totalUsers = User::all()->count();
        $searches;
        $usersDont = []; //array
        $charts = [];
        $userDontReply = []; //lista  de usuarios que NÂO responderam a pesquisa
        $userReply = 0; // //quantidade de usuarios que responderam a pesquisa
        $lastSearch = DB::table('searches')->orderBy('created_at', 'desc')->first();
        $search = Search::findOrFail($lastSearch->id);
        foreach ($search->users as $users) {
            $user = User::find($users->id);
            $searches = $user->searches()->where('search_id', $lastSearch->id)
                ->where('search_status', 0)->get();
            if ($searches->count() > 0) {

                $userDontReply[] = $user;
            }

            $userReply += $user->searches()->where('search_id', $lastSearch->id)
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
        $userObj = new User();
        //return response()->json(['opçao'=>$answers,'quantidade'=>$count,$questionsArray]);
        return view('home', compact(
            'questionsArray',
            'chart',
            'charts',
            'search',
            'textAnswers',
            'userDontReply',
            'question',
            'userObj',
            'totalUsers',
            'totalSearches'
        ));
       // return $searchesOfU;

    }


    public function teste(TypeQuestion $tipo)
    {
        $t = $tipo->find(2);
        foreach ($t->answers as $ans) {
            echo "$ans->answer <br>";
        }
    }
}
