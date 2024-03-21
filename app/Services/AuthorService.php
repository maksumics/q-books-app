<?php

namespace App\Services;

use App\Entities\Author;
use App\Repositories\AuthorRepository;

class AuthorService
{
    protected $authorRepo;

    public function __construct(AuthorRepository $repository)
    {
        $this->authorRepo = $repository;
    }

    public function setKey($key) {
        $this->authorRepo->setKey($key);
    }

    public function list($page, $limit = 10) {
        if (empty($limit)) {
            $this->authorRepo->setExcludeLimitCheck(true);
        }
        return $this->authorRepo->list($page, $limit, 'id', 'DESC');
    }

    protected function hasBooks($id) {
        $author = $this->get($id);
        return count($author->books);
    }

    public function get($id) {
        return $this->authorRepo->get($id);
    }

    public function create(Author $author) {
        return $this->authorRepo->create($author);
    }

    public function delete($id) {
        if ($this->hasBooks($id)) {
            return false;
        } else {
            $this->authorRepo->delete($id);
        }
    }
}
