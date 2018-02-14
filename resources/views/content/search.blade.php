@extends('master')

@section('content')
    @foreach($searchs as $search)
    <!-- First Blog Post -->
    <h2 style="margin-top: 80px">
        <b style="font-family: Italic" href="#"> {{ $search->title }}</b>
    </h2>

    <p class="lead">
        by <a href="index.php">Haleem</a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $search->created_at->diffForHumans() }}  </p>
    <img class="img-responsive" src="../upload/{{ $search->url }}" alt="">

    <p style="margin-top: 30px; color: #090909;">{{ $search->body }}</p>
    <hr>
    @endforeach






@stop