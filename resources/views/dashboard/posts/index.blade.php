@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My posts</h1>
</div>
@if (session('status'))
    <div class="alert alert-success mb-1">
        {{ session('status') }}
    </div>
@endif

<div class="table-responsive">
    {{-- <a href="/dashboard/posts/create" class="btn btn-primary">Create new post</a> --}}
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create new post</a>

    {{-- <a href="{{ route('dashboard.posts.create') }}" class="btn btn-primary">Create new post</a> --}}
    <table class="table table-striped table-sm">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $item)
        <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->title }}</td>
        <td>{{ $item->category->name }}</td>
            <td><a href="/dashboard/posts/{{ $item->slug }}" class="badge bg-info"><span data-feather="eye"></span></a></td>
            {{-- <td><a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a></td> --}}
            <td><a href="{{ route('posts.edit', $item->slug) }}" class="badge bg-warning"><span data-feather="edit"></span></a></td>
            <td>
                <form action="/dashboard/posts/{{ $item->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('apakah iya ?')"><span data-feather="x-circle"></span></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection