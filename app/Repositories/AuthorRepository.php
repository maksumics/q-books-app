<?php

namespace App\Repositories;

use App\Entities\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Support\Facades\Http;

class AuthorRepository extends HttpRepository implements AuthorRepositoryInterface
{
    public function __construct() {
        parent::__construct();
        $this->apiUriBase .= '/authors';
    }

    protected function getEntity() {
        return 'App\Entities\Author';
    }

    public function list($page, $limit = 10, $order = 'id', $direction = 'ASC') {
        $response = parent::list($page, $limit, $order, $direction);
        if ($response && $response->successful()) {
            $response = $response->json();
            
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
