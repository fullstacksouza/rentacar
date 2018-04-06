<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Search;
class QuestionController extends Controller
{
    //

    public function create(Request $request, $id)
    {
        $searchId = $id;
        return view('dashboard/searches/question-search',compact('searchId'));
    }
    public function store(Request $request)
    {
        //$search = Search::find($request->search_id);
        //if($request)
        dd("OK");
        return $request->search->answer;
    }
}
