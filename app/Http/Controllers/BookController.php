<?php

namespace App\Http\Controllers;

use App\Entities\Author;
use App\Entities\Book;
use App\Http\Requests\StoreBookRequest;
use App\Services\AuthorService;
use App\Services\BookService;

class BookController extends Controller
{
    protected $authorService;
    protected $bookService;
    public function __construct(AuthorService $authorService, BookService $bookService) {
        $this->authorService = $authorService;
        $this->bookService = $bookService;
    }
    public function create() {
        $result = $this->authorService->list(page: 1, limit: null);
        return view('book.create', ['authors' => $result['authors']]);
    }

    public function store(StoreBookRequest $request) {
        //$request->validate();
        $request = $request->validated();
        $request['author'] = $this->authorService->get($request['author']);
        $book = new Book($request);

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
