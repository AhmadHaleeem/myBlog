
@extends('master')

@section('content')

        <h1 class="page-header" style='margin-top: 95px'>
            Page Heading
            <small>Secondary Text</small>
        </h1>
        @foreach($posts as $post)
            <!-- First Blog Post -->
            <h2>
                <a href="/post/{{ $post->id }}">{{ $post->title }}</a>
            </h2>



            This Category is : <a href="../category/{{ $post->category->name }}" style="font-size: 18px; color: crimson">{{ $post->category->name }}</a>
            <p style="margin-top: 10px"><span class="glyphicon glyphicon-time"></span> Posted before  {{ $post->created_at->diffForHumans() }}</p>
             <img class="img-responsive" src="upload/{{ $post->url }}" alt="">

            <p style="margin-top: 30px; font-weight: bold; color: #AAA;">{{ $post->body }}</p>
            <a class="btn btn-primary" href="/post/{{ $post->id }}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            {{--<a href="posts/{{ $post->id }}/destroy" class="btn btn-danger">Delete</a>--}}

                @php
                    $like_count = 0;
                    $dislike_count = 0;
                    $like_status = 'btn-default';
                    $dislike_status = 'btn-default';
                @endphp
            @foreach($post->likes as $like)
                @php
                    if ($like->like == 1){
                        $like_count++;
                    }
                    if ($like->like == 0){
                        $dislike_count++;
                    }
                    if (Auth::check()) {
                         if ($like->like == 1 &&  $like->user_id == Auth::user()->id) {
                             $like_status = 'btn-success';
                        }
                        if ($like->like == 0 &&  $like->user_id == Auth::user()->id) {
                             $dislike_status = 'btn-danger';
                        }
                    }

                @endphp
            @endforeach
            <button class="like btn {{ $like_status }}" data-postid="{{ $post->id }}_l" data-like="{{ $like_status }}">Like <span class="glyphicon glyphicon-thumbs-up"></span> <b><span class="like_count"> {{ $like_count }}</span></b></button>
            <button class="dislike btn {{ $dislike_status }} " data-postid="{{ $post->id }}_d">Dislike <span class="glyphicon glyphicon-thumbs-down"></span> <b><span class="dislike_count"> {{ $dislike_count }}</span></b></button>
            <hr>
        @endforeach

        <form method='post' action="/posts/store" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" id="title" type="text" name="title"  placeholder="the tiltle">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
               <textarea class="form-control" id="body" name="body" placeholder="the body"></textarea>
            </div>
            <div class="form-group">
                <label for="url">Image</label>
               <input id="url" name="url" type="file" >
            </div>
            <div style="margin-top: -60px" class="form-group">
                <label for="category">Category</label>
                <select name="cat"  style="margin-top: 70px">
                    <option value="1">Network</option>
                    <option value="2">Mobile</option>
                    <option value="3">Culture</option>
                </select>
            </div>

            <div class="form-group">
                <button  class="btn btn-info" type="submit">Add Post</button>
            </div>
            @foreach($errors->all() as $error)
               <div class="alert alert-danger"> {{ $error }} </div>
            @endforeach
        </form>


@stop