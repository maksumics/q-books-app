<?php

namespace App\Repositories;

use App\Entities\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Support\Facades\Http;

class AuthorRepository implements AuthorRepositoryInterface
{
    protected $apiUriBase = 'https://symfony-skeleton.q-tests.com/api/v2/authors';
    protected $apiTokenKey;
    protected $excludeLimitCheck;

    public function __construct() {
        $this->apiTokenKey = session('token_key');
        $this->excludeLimitCheck = false;
    }

    public function setKey($key) {
        $this->apiTokenKey = $key;
    }

    public function setExcludeLimitCheck($value) {
        $this->excludeLimitCheck = (bool) $value;
    }

    public function list($page, $limit = 10, $order = 'id', $direction = 'ASC') {
        $data = [
            'limit'     => $limit ? $limit : 10,
            'order'     => $order ? $order : 'id',
            'direction' => $direction ? $direction : 'ASC',
            'page'      => $page
        ];
        $response = Http::withToken($this->apiTokenKey)->get($this->apiUriBase, $data);
        if ($response->successful()) {
            $response = $response->json();
            if ($this->excludeLimitCheck)  {
                $data = [
                    'limit' => $response['total_results']
                ];
                $response = Http::withToken($this->apiTokenKey)->get($this->apiUriBase, $data);
            }

            return [
                'authors'    => $this->authorMap($response['items'], true), 
                'totalCount' => $response['total_results'],
                'totalPages' => $response['total_pages'],
                'currentPage'=> $response['current_page']
            ];
        } else {
            return [];
        }
        
    }

    public function get($id) {
        $uri = sprintf('%s/%s', $this->apiUriBase, $id);
        $response = Http::withToken($this->apiTokenKey)->get($uri);
        if ($response->successful()) {
            return $this->authorMap($response->json());
        } else {
            return [];
        }
    }

    public function create($author) {
        $data = [
            'first_name' => $author->firstName,
            'last_name' => $author->lastName,
            'birthday' => $author->birthday,
            'gender' => $author->gender,
            'place_of_birth' => $author->placeOfBirth
        ];

        $response = Http::withToken($this->apiTokenKey)->post($this->apiUriBase, $data);
        return $response->successful() ? $response->json() : false;
    }

    public function delete($id) {
        $uri = sprintf('%s/%s', $this->apiUriBase, $id);
        $response = Http::withToken($this->apiTokenKey)->delete($uri);
        return $response->successful();
    }

    protected function authorMap($authors, $list = false) {
        return $list ? collect($authors)->map(function ($author) {
            return new Author(
                    $author['id'], 
                    $author['first_name'], 
                    $author['last_name'], 
                    $author['birthday'], 
                    $author['gender'], 
                    $author['place_of_birth']
                );
        }) : new Author($authors['id'], $authors['first_name'], 
                $authors['last_name'], 
                $authors['birthday'], 
                $authors['gender'], 
                $authors['place_of_birth'],
                $authors['books']
            );
    }
}
