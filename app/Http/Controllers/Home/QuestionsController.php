<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\StoreQuestion;
use App\Topic;
use Auth;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{

    public function __construct()
    {
        //定义中间件 except这些方法将不受中间件约束
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return 'question.index';
    }


    public function create()
    {
        $topics = Topic::select('id','name')->orderBy('id','desc')->get();

        return view('question.create',compact('topics'));
    }

    public function store(StoreQuestion $request)
    {
        dd($request->get('topics'));
        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id()
        ];

        $question = Question::create($data);

        return redirect()->route('question.show',$question->id);
    }


    public function show($id)
    {
        $question = Question::findOrFail($id);
        return view('question.show',compact('question'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
