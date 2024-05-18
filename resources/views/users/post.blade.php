@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                All Posts of {{ $user->name }}
            </div>
            @foreach ($user->posts as $post)
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <p class="form-control">{{ $post->title }}</p>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <p name="description" id="description" class="form-control">{{ $post->description }}</p>
                    </div>
                    <div class="form-group">
                        <img src="{{ asset($post->image) }}" alt="">
                    </div>
                    <div class="comments m-5">
                        <h4>All Comments</h4>
                        @foreach ($post->comments as $comment)
                            <div class="form-group">
                                <label for="">Comment by {{ $comment->user->name }}</label>
                                <p class="form-control">{{ $comment->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
