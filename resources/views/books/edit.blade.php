@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Book</h1>
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ $book->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="cover_image">Cover Image</label>
                <input type="file" name="cover_image" class="form-control">
                @if ($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="mt-2" width="100">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
