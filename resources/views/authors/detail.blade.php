@extends('layouts.default')
@section('title')
    {{ $author->firstName }} {{ $author->lastName }}
@endsection
@section('content')

<div class="info-container">
    <h2>{{ $author->firstName }} {{ $author->lastName }}</h2>
    <div class="box-info">
        <div class="box-info-item">
            <span class="label">Born on:</span>
            <span class="value">{{ $author->birthday }}</span>
        </div>
        <div class="box-info-item">
            <span class="label">Gender:</span>
            <span class="value">{{ $author->gender }}</span>
        </div>
        <div class="box-info-item">
            <span class="label">Born place:</span>
            <span class="value">{{ $author->placeOfBirth }}</span>
        </div>
    </div>
</div>
<h3>{{ $author->firstName }}'s books</h3>

@if (count($author->books))
<table>
    <thead>
        <tr>
            <td>Title</td>
            <td>Release date</td>
            <td>ISBN</td>
            <td>Format</td>
            <td>Page numbers</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($author->books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->releaseDate }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->format }}</td>
                <td>{{ $book->pageNumbers }}</td>
                <td><a href="{{ route('book-delete', ['id' => $book->id]) }}" >Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No books to show.</p>
@endif
@endsection