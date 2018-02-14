@extends('master')

@section('content')

    <!-- First Blog Post -->
    <h2 style="margin-top: 80px">
        <b href="#">{{ $post->title }}</b>
    </h2>

    <p class="lead">
        by <a href="index.php">Haleem</a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->diffForHumans() }}  </p>
    <img class="img-responsive" src="../upload/{{ $post->url }}" alt="">

    <p style="margin-top: 30px; color: #090909;">{{ $post->body }}</p>
    <hr>
    @foreach($post->comments as $comment)
        <div style="position: relative; margin-bottom: 10px" class='comment'>
            <span style="color: #d62728"> {{ $comment->created_at->diffForHumans() }}</span>
            <p>{{ $comment->body }} </p>
            <form>
                <a style="position: absolute; top: 20px; right: 10px; display: block" class="btn btn-danger pull-right" href="/{{$comment->id}}/delete">Delete</a>
                <a style="position: absolute; top: 20px; right: 80px; display: block" class="btn btn-info pull-right" href="/{{$comment->id}}/edit">Edit</a>
            </form>
        </div>
    @endforeach

    <form method='post' action='/{{$post->id}}/store' >
        {{ csrf_field() }}
        <div class='form-group'>
            <label for='body'>Write your Comment . . .</label>
            <textarea name='body' id='body' class='form-control' required></textarea>
        </div>

        <div class='form-group'>
            <button type='submit' class='btn btn-primary'>Add Comment</button>
        </div>
    </form>

@stop
