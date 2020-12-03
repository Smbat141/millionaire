@extends('layouts.app')

@section('content')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {{$errors->first()}}
            </div>
        @endif
        @if(count($games) > 0)
            <h1>Game results</h1>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">User Name</th>
                    <th scope="col">Points</th>
                </tr>
                </thead>
                <tbody>
                @foreach($games as $game)
                    <tr>
                        <th scope="row">{{$game->user->username}}</th>
                        <td>{{$game->total_count}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h1>There are not games</h1>
        @endif

        @if(count(auth()->user()->games) > 0)
            <h1>My results</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Points</th>
                </tr>
                </thead>
                <tbody>
                @foreach(auth()->user()->games->sortByDesc('total_count') as $game)
                    <tr>
                        <td>{{$game->total_count}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection
