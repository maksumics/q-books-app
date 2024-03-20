<?php

namespace App\Repositories\Interfaces;

use App\Entities\Author;

interface AuthorRepositoryInterface
{
    public function list($page);

    public function get($id);

    public function create(Author $author);

    public function delete($id);
}