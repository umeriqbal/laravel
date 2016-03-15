@extends('layouts.master')

@section('content')
<style>
    .input-group label{
        text-align:left;
    }
</style>
<form method="post" action="">
     <div class="input-group">
        <label for="name">Your Name</label>
        <input type="text" name="author" id="author" placeholder="Your Name" />
    </div>
     <div class="input-group">
        <label for="password">Your Password</label>
        <input type="password" name="password" id="password" placeholder="Your Passworde" />
    </div>
    <button type="submit">Submit</button>
</form>
@endsection