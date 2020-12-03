@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Answer Body - {{$answer->body}}</h1>
        @if($answer->is_correct)
            <h1>Is correct</h1>
        @else
            <h1>Is not correct</h1>
        @endif
    <div>
@endsection
