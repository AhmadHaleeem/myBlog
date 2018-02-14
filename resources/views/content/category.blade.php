@extends('master')



@section('content')

    <h1 class="page-header" style='margin-top: 95px'>
        Page Heading
        <small>Secondary Text</small>
    </h1>
    @foreach($posts as $post)
        <!-- First Blog Post -->
        <h2>
            <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
        </h2>

        <p class="lead">
            by <a href="index.php">Haleem</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->diffForHumans () }}</p>

        @if ($post->url)
            <img class="img-responsive" src="../upload/{{ $post->url }}" alt="">
        @endif
        <hr>
        <p >{{ $post->body }}</p>


        <hr>
    @endforeach

    <form method='post' action='/posts/store' enctype='multipart/form-data'>
        {{ csrf_field() }}
        <div class='form-group'>
            <label for='title'>Title</label>
            <input type='text' name='title' id='title' class='form-control'>
        </div>
        <div class='form-group'>
            <label for='body'>Body</label>
            <textarea name='body' id='body' class='form-control'></textarea>
        </div>
        <div class='form-group'>
            <label for='url'>Image</label>
            <input id='url' type="file" name="url">
        </div>
        <div class='form-group'>
            <button type='submit' class='btn btn-primary'>Add Post</button>
        </div>
        @foreach($errors->all() as $error)
            <div class='alert alert-danger'>{{ $error }}</div>
        @endforeach
    </form>


@stop
