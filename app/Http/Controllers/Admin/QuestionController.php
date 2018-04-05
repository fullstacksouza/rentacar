<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    //

    public function create(Request $request)
    {
        
        return view('dashboard/searches/question-search');
    }
    public function store(Request $request)
    {
        return $request->all();
    }
}
