@extends('layouts.default')
@section('title')
    Lists of authors
@endsection
@section('content')
<div class="container">
    @if(count($data['authors']))
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
            @foreach($data['authors'] as $author)
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
        <tfoot>
            <tr>
                <td>
                    <p>Showing {{ count($data['authors']) }} of {{ $data['totalCount'] }}</p>
                </td>
                <td>
                    @if ($data['currentPage'] > 1) 
                            <a href="{{ route('authors-list', ['page' => ((int) $data['currentPage'])-1]) }}">Previous</a> 
                    @endif  
                    {{ $data['currentPage'] }} - ... - {{ $data['totalPages'] }} 
                    @if ($data['currentPage'] < $data['totalPages'])
                        <a href="{{ route('authors-list', ['page' => ((int) $data['currentPage'])+1]) }}">Next</a> 
                    @endif
                </td>
            </tr>
            
        </tfoot>
    </table>
    @else
        <p>No authors to show.</p>
    @endif
</div>
@endsection