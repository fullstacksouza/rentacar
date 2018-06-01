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
        $searches;
        $usersDont = []; //array
        $charts = [];
        $userDontReply = []; //lista  de usuarios que NÂO responderam a pesquisa
        $userReply = 0; // //quantidade de usuarios que responderam a pesquisa
        $lastSearchId = DB::table("searches")->orderBy("id", 'desc')->first();
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

        return view('home', compact('chart'));
    }

    public function teste(TypeQuestion $tipo)
    {
        $t = $tipo->find(2);
        foreach ($t->answers as $ans) {
            echo "$ans->answer <br>";
        }
    }
}
