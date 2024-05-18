@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                All Posts
            </div>
            <div class="card-body">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Add New Post</a>
                <!-- table -->
                <table class="table datatables" id="dataTable-1">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Sr#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $counter = 1 @endphp
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->description }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td id="btn{{ $post->id }}">
                                    <a href="{{ route('posts.show', $post->id) }}"
                                        class="btn btn-sm btn-secondary rounded text-muted" type="button">
                                        <span class="text-white sr-only">Show</span>
                                    </a>   
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                        class="btn btn-sm btn-secondary rounded text-muted" type="button">
                                        <span class="text-white sr-only">Edit</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
