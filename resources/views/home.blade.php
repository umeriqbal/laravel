@extends('layouts.master')

@section('content')
    <div class="centered">
        @foreach($actions as $action)
            <a href="{{ route('niceaction', ['action' => lcfirst($action->name)]) }}">{{ $action->name }}</a>
        @endforeach
        
        
        <!--
        <a href="{{ route('niceaction', ['action' => 'greet']) }}">Greet</a>
         <a href="{{ route('niceaction', ['action' => 'hug']) }}">Hug</a>
         <a href="{{ route('niceaction', ['action' => 'kick']) }}">Kick</a>
         -->
        <br />
        @if (count($errors) > 0)
            <div>
                <ul>
                    @foreach($errors->all()  as $error)
                        {{ $error }}
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('add_action') }}" method="post">
            <label for="name">Name</label>
            <input type="text" name="name"/>
            
            <label for="niceness">Niceness</label>
            <input type="text" name="niceness"/>
            <button type="submit">Do a nice action!</button>
            <input type="hidden" value="{{ Session::token() }}" name="_token" />
        </form>
        <br /><br />
        
        <ul>
            @foreach($logged_actions as $logged_action)
                <li>{{ $logged_action->nice_action->name }}</li>
                <!--
                @foreach($logged_action->nice_action->categories as $category)
                    {{ $category->name }}
                @endforeach
                -->
            @endforeach
         </ul>
         {{ dd($db) }}
    </div>
@endsection