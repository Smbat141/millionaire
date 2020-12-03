<?php

namespace App\Http\Requests;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class EditQuestionAnswer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $question_id = $this->route()->parameters()['question'];
        $answers = Question::where('id', $question_id)->first()->answers;
        $correct_answers = 0;

        foreach ($answers as $answer){
            if($answer->is_correct){
                $correct_answers += 1;
            }
        }
        return [
            'body' => 'required|string|max:255',
            'is_correct' => new RequiredIf($correct_answers <= 1)
        ];
    }


    public function messages()
    {
        return [
            'is_correct.required' => 'Question should have 1 or more correct answers',
        ];
    }
}
