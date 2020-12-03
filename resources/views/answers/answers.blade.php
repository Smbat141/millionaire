@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$question->body}} ------- Answers</h1>
        <a href="{{route('question.answers.create',['question' => $question->id])}}" type="button" class="btn btn-primary mb-5">Create answer</a>
        @if(count($answers) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Answer</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($answers as $answer)
                    <tr>
                        <th scope="row">{{$answer->id}}</th>
                        <td>{{$answer->body}}</td>
                        <td>{{$answer->is_correct ? 'correct' : 'incorrect'}}</td>
                        <td>
                            <a href="{{route('question.answers.edit',['question' => $question->id,'answer' => $answer->id])}}" type="button" class="btn btn-primary">Edit</a>
                            <form action="{{route('question.answers.destroy',['question' => $question->id,'answer' => $answer->id])}}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button  type="submit" class="btn btn-primary">Delete</button>
                            </form>
                            <a href="{{route('question.answers.show',['question' => $question->id,'answer' => $answer->id])}}" type="button" class="btn btn-primary">Show</a>

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{$errors->first()}}
                </div>
            @endif
        @else
            <h1>There are no answers</h1>
        @endif
    </div>


@endsection

