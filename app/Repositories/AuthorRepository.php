<?php

namespace App\Repositories;

use App\Entities\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Support\Facades\Http;

class AuthorRepository extends HttpRepository implements AuthorRepositoryInterface
{
    protected $excludeLimitCheck;

    public function __construct() {
        parent::__construct();
        $this->apiUriBase .= '/authors';
        $this->excludeLimitCheck = false;
    }

    protected function getEntity() {
        return 'App\Entities\Author';
    }

    public function setExcludeLimitCheck($value) {
        $this->excludeLimitCheck = (bool) $value;
    }

    public function list($page, $limit = 10, $order = 'id', $direction = 'ASC') {
        $response = parent::list($page, $limit, $order, $direction);
        if ($response && $response->successful()) {
            $response = $response->json();
            if ($this->excludeLimitCheck)  {
                $data = [
                    'limit' => $response['total_results']
                ];
                $response = Http::withToken($this->apiTokenKey)->get($this->apiUriBase, $data);
            }
            
            $author = new Author();
            return [
                'authors'    => $author->setModelAttributes($response['items'], list: true), 
                'totalCount' => $response['total_results'],
                'totalPages' => $response['total_pages'],
                'currentPage'=> $response['current_page']
            ];
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

        return $this->add($data);
    }
}
