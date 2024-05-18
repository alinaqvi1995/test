@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Add Posts
            </div>
            <div class="card-body">
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Post Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Post Description</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Post Image</label>
                        <input type="file" alt="" name="image" id="image" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
