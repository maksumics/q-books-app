@extends('layouts.default')
@section('title')
List
@endsection
@section('content')
<h3>{{ $author->firstName }} {{ $author->lastName }}</h3>

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