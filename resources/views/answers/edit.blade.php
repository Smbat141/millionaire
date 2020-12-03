@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Answer for question - <b>{{$question->body}}</b></h1>
        <form class="form-group" id="questions" action="{{route('question.answers.update',['question' => $question->id,'answer' => $answer->id])}}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="question_body">Answers</label>
                <input type="text" value="{{$answer->body}}" name="body" class="form-control @error('body') is-invalid @enderror" id="question_body" placeholder="Version 1" required>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" @if($answer->is_correct) checked="checked" @endif value="{{true}}" id="is_true" name="is_correct">
                    <label class="form-check-label" for="is_true">
                        This answer is true
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        @error('body')
         <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('is_correct')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

@endsection
