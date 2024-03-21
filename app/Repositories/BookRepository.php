<?php

namespace App\Repositories;

use App\Entities\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Support\Facades\Http;

class BookRepository extends HttpRepository implements BookRepositoryInterface
{
    public function __construct() {
        parent::__construct();
        $this->apiUriBase .= '/books';
    }

    protected function getEntity() {
        return 'App\Entities\Book';
    }

    public function list($page, $limit = 10, $order = 'id', $direction = 'ASC') {
        $response = parent::list($page, $limit, $order, $direction);
        if ($response && $response->successful()) {
            $response = $response->json();
            $book = new Book();
            return $book->setModelAttributes($response->json(), list: true);
        } else {
            return [];
        }
        
    }

    public function create(Book $book) {
        $data = [
            'author' => [
                'id' => $book->author->id
            ],
            'title' => $book->title,
            'description' => $book->description,
            'release_date' => $book->releaseDate,
            'isbn' => $book->isbn,
            'format' => $book->format,
            'number_of_pages' => (int) $book->pageNumbers
        ];

        return $this->add($data);
    }
}
