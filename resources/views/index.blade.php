@extends('layouts.master')

@section('title')
    Trending Quotes
@endsection

@section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
@endsection

@section('content')
    <section class="quotes">
        <h1>Latest Quotes</h1>
        
        @for($i=0; $i<count($quotes); $i++)
            <article class="quote{{ $i % 3 === 0 ? ' first-in-line' : (($i+ 1) % 3 === 0 ? ' last-in-line' : '') }}">
                <div class="delete"><a href="">X</a></div>
               {{ $quotes[$i]->quote }}
                <div class="info">Created by <a href="">{{ $quotes[$i]->author->name }}</a> on {{ $quotes[$i]->created_at }}</div>
            </article>
        @endfor
        <div class="pagination">
            Pagination
        </div>
    </section>
    
    <section class="edit-quote">
        <h1>Add a Quote</h1>
        <form method="post" action="{{ route('create') }}">
            <div class="input-group">
                <label for="author">Your Name</label>
                <input type="text" name="author" id="author" placeholder="Your Name" />
            </div>
             <div class="input-group">
                <label for="quote">Your Quote</label>
                <textarea name="quote" id="quote" rows="5" placeholder="Quote"></textarea>
            </div>
            <button type="submit" class="btn">Submit Quote</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </section>
@endsection

