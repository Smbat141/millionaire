<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteQuestionAnswer;
use App\Http\Requests\EditQuestionAnswer;
use App\Http\Requests\QuestionAnswer;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($question_id)
    {

        $question = Question::where('id', $question_id)->first();
        $answers = $question->answers;
        return response()->view('answers.answers', ['question' => $question,'answers' => $answers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($question_id)
    {
        $question = Question::where('id',$question_id)->first();

        return view('answers.create', ['question' => $question]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionAnswer $request, $question_id)
    {
        $params = $request->except('_token');
        $data = [];

        $data['body'] = $params['body'];
        $data['question_id'] = $question_id;
        if(isset($params['is_correct']) and  $params['is_correct']){
            $data['is_correct'] = true;
        }

        Answer::create($data);

        return redirect()->route('question.answers.index',['question' => $question_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($question_id, $answer_id)
    {
        $answer = Answer::where('id', $answer_id)->first();
        return view('answers.answer_details',['answer' => $answer] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $question_id
     * @param $answer_id
     * @return void
     */
    public function edit($question_id, $answer_id)
    {

        $question = Question::where('id',$question_id)->first();
        $answer = Answer::where('id',$answer_id)->first();

        return view('answers.edit', ['question' => $question, 'answer' => $answer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $question_id
     * @param $answer_id
     * @return void
     */
    public function update(EditQuestionAnswer $request, $question_id, $answer_id)
    {
        $data = $request->except('_token','_method');

        $answer = Answer::where('id', $answer_id)->first();

        $updated_data['body'] = $data['body'];

        if(isset($data['is_correct']) and  $data['is_correct']){
            $updated_data['is_correct'] = $data['is_correct'];
        }else{
            $updated_data['is_correct'] = false;
        }
        $answer->update($updated_data);

        return redirect()->route('question.answers.index',['question' => $question_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $question_id
     * @param $answer_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($question_id, $answer_id)
    {
        $answer = Answer::where('id',$answer_id)->first();
        $question = Question::where('id', $question_id)->first();

        $correct_answers = $question->answers->where('is_correct', true);

        if(count($correct_answers) > 1){
            $answer->delete();
        }
        else if($correct_answers->first()->id == $answer_id) {
            return redirect()->back()->withErrors('Question should have 1 or more correct answers');
        }

        return redirect()->route('question.answers.index',['question' => $question_id]);
    }
}
