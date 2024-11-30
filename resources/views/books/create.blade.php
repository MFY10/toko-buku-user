@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Book</h1>
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="cover_image">Cover Image</label>
                <input type="file" name="cover_image" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
