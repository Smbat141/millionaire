@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Question Body - {{$question->body}}</h1>
        <h1>Question Level - {{$question->level}}</h1>
    </div>
@endsection
