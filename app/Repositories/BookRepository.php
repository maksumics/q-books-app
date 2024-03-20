<?php

namespace App\Repositories;

use App\Entities\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Support\Facades\Http;

class BookRepository implements BookRepositoryInterface
{
    protected $apiUriBase = 'https://symfony-skeleton.q-tests.com/api/v2/books';
    protected $apiTokenKey;

    public function __construct() {
        $this->apiTokenKey = session('token_key');
    }

    public function list($page, $limit = 10) {
        $data = [
            'limit' => $limit ? $limit : 10,
            'page' => $page
        ];
        $response = Http::withToken($this->apiTokenKey)->get($this->apiUriBase, $data);
        if ($response->successful()) {
            $response = $response->json();
            return $this->bookMap($response['items'], true);
        } else {
            return [];
        }
        
    }

    public function get($id) {
        $uri = sprintf('%s/%s', $this->apiUriBase, $id);
        $response = Http::withToken($this->apiTokenKey)->get($uri);
        if ($response->successful()) {
            return $this->bookMap($response->json());
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
        $response = Http::withToken($this->apiTokenKey)->post($this->apiUriBase, $data);
        return $response->successful() ? $response->json() : false;
    }

    public function update() {

    }

    public function delete($id) {
        $uri = sprintf('%s/%s', $this->apiUriBase, $id);
        $response = Http::withToken($this->apiTokenKey)->delete($uri);
        return $response->successful();
    }

    protected function bookMap($books, $list = false) {
        return $list ? collect($books)->map(function ($book) {
            return new Book(
                    $book['id'], 
                    $book['title'], 
                    $book['release_date'], 
                    $book['description'], 
                    $book['isbn'], 
                    $book['format'],
                    $book['number_of_pages']
                );
        }) : new Book(
                    $books['id'], 
                    $books['title'], 
                    $books['release_date'], 
                    $books['description'], 
                    $books['isbn'], 
                    $books['format'],
                    $books['number_of_pages']
            );
    }
}
