@extends('layouts.default')
@section('title')
List
@endsection
@section('content')
<div class="container">
    <table>
        <thead>
            <tr>
                <td>First name</td>
                <td>Last name</td>
                <td>Birthday</td>
                <td>Gender</td>
                <td>Birth place</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($authors as $author)
            <tr>
                <td> {{ $author->firstName }}</td>
                <td> {{ $author->lastName }}</td>
                <td> {{ $author->birthday }}</td>
                <td> {{ $author->gender }}</td>
                <td> {{ $author->placeOfBirth }}</td>
                <td><a href="{{ route('author-detail', ['id' => $author->id]) }}">Detail</a></td>
                <td><a href="{{ route('author-delete', ['id' => $author->id]) }}">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop