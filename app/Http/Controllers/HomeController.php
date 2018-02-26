<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chart = Charts::create('pie', 'highcharts')
        ->title('Indice de Satisfação')
        ->labels(['Satisfeito', 'Insatisfeito', 'Pouco Satisfeito','Muito Satisfeito'])
        ->values([5,10,20,10])
        ->dimensions(1000,500)
        ->responsive(true);

         return view('home',compact('chart'));
    }
}
