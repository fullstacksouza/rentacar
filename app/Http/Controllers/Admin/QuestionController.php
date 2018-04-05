<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return $request->all();
    }
}
