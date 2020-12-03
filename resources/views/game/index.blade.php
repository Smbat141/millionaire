@extends('layouts.app')

@section('content')
    <div class="container">
        @if($game->status == 'in_process')
            <h2>{{$question->body}}</h2>
            <h2>{{$game->total_count}}</h2>
            <form class="mt-5" action="{{route('check_question')}}" method="post">
                <input name="question_id" type="hidden" value="{{$question->id}}">
                <input name="game_id" type="hidden" value="{{$game->id}}">
                @csrf
                @foreach($question->answers as $answer)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="answered_ids[]" type="checkbox" id="{{$answer->id}}" value="{{$answer->id}}">
                        <label class="form-check-label" for="{{$answer->id}}">{{$answer->body}}</label>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">to answer</button>
            </form>
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{$errors->first()}}
                </div>
            @endif

        @else
            <div class="alert alert-success text-center" role="alert">
                <h1>Finish</h1>
                <h1>Total counts - {{$game->total_count}}</h1>
            </div>
        @endif
    </div>
@endsection
