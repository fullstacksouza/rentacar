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
        $searches;
        $totalUsers = User::all()->count();
        $totalSearches = Search::all()->count();
        $usersDont = []; //array
        $charts = [];
        $userDontReply = []; //lista  de usuarios que NÂO responderam a pesquisa
        $userReply = 0; // //quantidade de usuarios que responderam a pesquisa
        $lastSearchId = DB::table("searches")->orderBy("id", 'desc')->first();

        if ($lastSearchId) {
            $search = Search::find($lastSearchId->id);
            foreach ($search->users as $users) {
                $user = User::find($users->id);
                $searches = $user->searches()->where('search_id', $search->id)
                    ->where('search_status', 0)->get();
                if ($searches->count() > 0) {

                    $userDontReply[] = $user;
                }


                $userReply += $user->searches()->where('search_id', $search->id)
                    ->where('search_status', 1)->count();
            }


            $chart = Charts::create('pie', 'highcharts')
                ->title('Quantidade de usuarios que responderam')
                ->labels(['Responderam', 'Não responderam'])
                ->values([$userReply, (count($userDontReply))])
                ->dimensions(1000, 500)
                ->responsive(true);

            return view('home', compact('chart', 'totalUsers', 'totalSearches'));
        }

        return view('home', compact('totalUsers', 'totalSearches'));
    }

    public function teste(TypeQuestion $tipo)
    {
        $t = $tipo->find(2);
        foreach ($t->answers as $ans) {
            echo "$ans->answer <br>";
        }
    }
}
