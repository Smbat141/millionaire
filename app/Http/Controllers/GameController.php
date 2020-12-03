<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Game;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use Illuminate\Http\Request;
use Session;


// WE COULD USE THE <REPOSITORY> PATTERN AND WRITE LOGIC THERE

class GameController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function startGame(){

        $questions = Question::has('answers')->get();
        if(count($questions) == 0){
            return redirect()->route('home')->withErrors(['Please create Questions with answers']);
        }
        $game = Game::create([
            'user_id' => auth()->user()->id,
            'total_count' => 0,
            'questions_count' => 0,
            'status' => 'in_process',
        ]);
        $question = $this->getRandomQuestion($game);

        return redirect()->route('play_game',['game_id' => $game->id, 'question_id' => $question->id]);
    }


    public function playGame(Request $request, $game_id, $question_id){

        $game = Game::where('id', $game_id)->first();
        $question = Question::where('id', $question_id)->first();

        if($game->questions_count == 5){
            $game->status = 'finished';
            $game->save();
        }

        return view('game.index', ['game' => $game, 'question' => $question]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkQuestion(Request $request){

        $params = $request->except('_token');

        // validate params in Form Request class
        Validator::make($params, [
            'answered_ids' => 'required'
        ],['answered_ids.required' => 'Please Choose any answer'])->validate();


        $question = Question::where('id', $params['question_id'])->first();
        $game = Game::where('id', $params['game_id'])->first();
        $correct_answers = $question->answers->where('is_correct', true);
        $wrong_answers = Answer::whereIn('id', $params['answered_ids'])->where('is_correct',false)->get();

        // check if the user has selected more or less answers
        if(count($params['answered_ids']) !== count($correct_answers)){
            return redirect()->back()->withErrors(['Question correct answers count - '.count($correct_answers)]);
        }
        elseif(count($wrong_answers) > 0){
            $error_message = '';
            foreach ($correct_answers as $answer){
                $error_message .= "$answer->body,";
            }

            return redirect()->back()->withErrors(['Answer is wrong, correct Answer is '.$error_message]);
        }else{
            $this->saveGame($game, $question);
            $this->saveGameQuestions($game, $question);
            $question = $question = $this->getRandomQuestion($game);

            if ($question == null){
                $game->status = 'finished';
                $game->save();

                return redirect()->route('play_game',['game_id' => $game->id, 'question_id' => $params['question_id']]);

            }

            return redirect()->route('play_game',['game_id' => $game->id, 'question_id' => $question->id]);
        }


    }

    /**
     * @param $game
     * @return mixed
     */
    public function getRandomQuestion($game){
        // get already exist questions for current game
        $questions_ids = $game->questions->pluck('id')->toArray();

        return Question::inRandomOrder()
            ->has('answers')
            ->whereNotIn('id', $questions_ids)
            ->first();
    }


    /**
     * @param $game
     * @param $question
     */
    public function saveGame($game, $question){
        $game->total_count = $game->total_count + $question->level;
        $game->questions_count = $game->questions_count + 1;
        $game->save();
    }

    /**
     * @param $game
     * @param $question
     */
    public function saveGameQuestions($game, $question){
        $game->questions()->attach($question->id);
    }

}
