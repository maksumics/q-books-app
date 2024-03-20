<?php

namespace App\Services;

use App\Entities\Book;
use App\Repositories\BookRepository;

class BookService
{
    protected $bookRepo;
    protected $authorService;

    public function __construct(BookRepository $repository, AuthorService $authorService)
    {
        $this->bookRepo = $repository;
        $this->authorService = $authorService;
    }

    public function list($page, $limit = 10) {
        return $this->bookRepo->list($page, $limit);
    }

    public function getAuthors() {
        return $this->authorService->list(page: 1, limit: null);
    }

    public function get($id) {
        return $this->bookRepo->get($id);
    }

    public function create(Book $author) {
        return $this->bookRepo->create($author);
    }

    public function delete($id) {
        return $this->bookRepo->delete($id);
    }
}
