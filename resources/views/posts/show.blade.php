@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{-- Add Posts --}}
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}" readonly
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" readonly>{{ $post->description }}</textarea>
                </div>
                <div class="form-group">
                    <img src="{{ asset($post->image) }}" alt="">
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                Add Comment
            </div>
            <div class="card-body">
                <form action="{{ route('comments.store', $post->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea name="comment" id="comment" class="form-control" cols="30" rows="3" required placeholder="Add your comment here..."></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Comment</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                All Comments
            </div>
            <div class="card-body">
                <table class="table datatables" id="dataTable-1">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>User</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $counter = 1 @endphp
                        @foreach ($post->comments as $comment)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $comment->user->name }}</td>
                                <td>{{ $comment->comment }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
