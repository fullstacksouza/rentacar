<?php

namespace App\Http\Controllers\Front;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Search;
use App\Admin\Question;
use App\Admin\UserTextAnswer;
use App\Admin\AnswerOption;
use App\User;
class UserController extends Controller
{

    public function edit(Request $request)
    {
        $userEdit = \Auth::user();
        if($userEdit)
        {
            return view('front/user/profile-edit',compact('userEdit'));
        }
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);
        if($request->email)
        {
            $user->email = $request->email;
        }

        $user->name = $request->name;
        $user->save();
        return redirect()->back()->with('info', 'Perfil Atualizado com Sucesso');
    }

    public function getSearches()
    {

        $user = \Auth::user();
        $updateStatus = DB::table("user_searches")
        ->where('user_id',\Auth::user()->id)
        ->where('search_status',0)
        ->get();
        $searches = $user->searches()
        ->where('search_status',0)
        ->where('status','=',1)->whereDate('date_start','=',date('y-m-d'))->get();

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

    public function sendAnswers(Request $request,UserTextAnswer $userTextAnswer)
    {
        $current_user = \Auth::user();
        $texAnswer;
        $data = [
            'user_id'=>$current_user->id,
            'search_id'=>$request->searchID,
            'search_status'=> 1
        ];
        $current_user->searches()->updateExistingPivot(['search_id'=>$request->searchID],['search_status'=>1]);
       //$current_user->searches()->attach(['search_id'=>$request->searchID,['search_status'=>1]]);
        // criar migration user_text_answers contendo user_id,question_id,text answer
        $answers = [];
        foreach($request->answers as $answer)
        {
            //verificando se o usuario selecinou alguma resposta
            if($answer['choice'] == null)
            {
                $userTextAnswer = UserTextAnswer::create([
                    'answer'=> $answer['answer_text'],
                    'user_id'=>$current_user->id,
                    'question_id'=>$answer['question']

                ]);

            }
            else
            {
            $answerChoosed = AnswerOption::find($answer['choice']);
            $answerChoosed->users()->attach($current_user);

            }

        }
        return $answers;
    }
}
