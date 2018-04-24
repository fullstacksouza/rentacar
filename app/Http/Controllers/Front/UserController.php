<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Search;
class UserController extends Controller
{

    public function getSearches()
    {

        $user = \Auth::user();
        $searches = $user->searches()->where('status','=',1)->whereDate('date_start','=',date('y-m-d'))->get();

        return view("front/user/searches",compact('searches'));

    }

    public function replySearch(Request $request)
    {
        $search = Search::findOrFail($request->id);
        if($search)
        {
            return view('front/user/search-reply',compact("search"));
        }

        return redirect()->back();
    }
    public function searchJson(Request $request)
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

    public function sendAnswers(Request $request)
    {
        // criar migration user_text_answers contendo user_id,question_id,text answer
        $answers = [];
        foreach($request->answers as $answer)
        {
            //verificando se o usuario selecinou alguma resposta
            if($answer['choice'] == null)
            {
                $answers[] = $answer['answer_text'];
            }
        }
        return $answers;
    }
}
