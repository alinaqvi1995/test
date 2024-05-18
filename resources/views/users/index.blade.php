@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Users</h1>
    @foreach($users as $user)
        <div class="card mb-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h2>User: {{ $user->name }}</h2>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="{{ route('users.posts', $user->id) }}" class="btn btn-secondary">View</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($user->posts->count())
                    @foreach($user->posts as $post)
                        <div class="mb-4">
                            <h3>{{ $post->title }}</h3>
                            <p>{{ $post->description }}</p>
                            <p><img src="{{ asset($post->image) }}" alt="{{ $post->title }}" width="200"></p>
                            <h4>Comments:</h4>
                            @if($post->comments->count())
                                @foreach($post->comments as $comment)
                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <p>{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No comments yet.</p>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p>No posts yet.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
