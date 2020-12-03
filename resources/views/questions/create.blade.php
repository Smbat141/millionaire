@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('question.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="question_body">Question</label>
                <input type="text" name="body" class="form-control" id="question_body" placeholder="Who are you?" required>
            </div>
            <div class="form-group">
                <label for="level">Select your question level</label>
                <select class="form-control" id="level" name="level" required>
                    @foreach(range(5, 20) as $number)
                        <option>{{$number}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    <div>
@endsection
