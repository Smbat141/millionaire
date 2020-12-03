@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Questions</h1>
        <a href="{{route('question.create')}}" class="btn btn-primary mb-5">Create Question</a>
        @if(count($questions) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Question</th>
                    <th scope="col">Level</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $question)
                    <tr>
                        <th scope="row">{{$question->id}}</th>
                        <td>{{$question->body}}</td>
                        <td>{{$question->level}}</td>
                        <td>
                            <a href="{{route('question.answers.create',['question' => $question->id])}}" type="button" class="btn btn-primary">Create answer</a>
                            @if(count($question->answers) > 0)
                                <a href="{{route('question.answers.index',['question' => $question->id])}}" type="button" class="btn btn-primary">Answers</a>
                            @endif
                            <a href="{{route('question.edit',['question' => $question->id])}}" type="button" class="btn btn-primary">Edit</a>
                            <form action="{{route('question.destroy',['question' => $question->id])}}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button  type="submit" class="btn btn-primary">Delete</button>
                            </form>
                            <a href="{{route('question.show',['question' => $question->id])}}" type="button" class="btn btn-primary">Show</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h1>There are no questions</h1>
        @endif
    </div>
@endsection
