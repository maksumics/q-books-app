@extends('layouts.default')
@section('title')
New book
@endsection
@section('content')
<div class="form-container">
    <form method="post" action="store">
        @csrf
        <div class="form-group">
            <label for="title">Book title</label>
            <input name="title" type="text" placeholder="Title" required />
        </div>
        <div class="form-group">
            <label for="releaseDate">Release date</label>
            <input name="releaseDate" type="date" required/>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input name="description" type="text" placeholder="enter description" required />
        </div>
        <div class="form-group">
            <label for="description">ISBN</label>
            <input name="isbn" type="text" placeholder="isbn" required />
        </div>
        <div class="form-group">
            <label for="format">Format</label>
            <input name="format" type="text" placeholder="enter format" required />
        </div>
        <div class="form-group">
            <label for="pageNumbers">Page numbers</label>
            <input name="pageNumbers" type="number" step="1" required />
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <select name="author" required>
                <option value="">Select an author</option>
                @foreach ($authors as $author)
                <option value="{{ $author->id }}">{{ $author->firstName }} {{ $author->lastName }}</option>
                @endforeach
            </select>
        </div>

        <input class="btn" type="submit" value="Add book" />
    </form>
</div>
@endsection