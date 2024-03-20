<?php

namespace App\Http\Controllers;

use App\Entities\Author;
use App\Entities\Book;
use App\Services\AuthorService;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $authorService;
    protected $bookService;
    public function __construct(AuthorService $authorService, BookService $bookService) {
        $this->authorService = $authorService;
        $this->bookService = $bookService;
    }
    public function create() {
        $authors = $this->authorService->list(page: 1, limit: null);
        return view('book.create', ['authors' => $authors]);
    }

    public function store(Request $request) {
        $book = new Book(null, 
            $request['title'],
            $request['releaseDate'],
            $request['description'],
            $request['isbn'],
            $request['format'],
            $request['pageNumbers'],
            $this->authorService->get($request['author'])
        );

        if ($this->bookService->create($book)) {
            return redirect()->route('author-detail', ['id' => $book->author->id]);
        } else {
            return redirect()->back();
        }
    }

    public function delete($id) {
        $this->bookService->delete($id);
        return redirect()->back();
    }
}
