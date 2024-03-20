<?php

namespace App\Repositories\Interfaces;

use App\Entities\Book;

interface BookRepositoryInterface
{
    public function list($page);

    public function get($id);

    public function create(Book $author);

    public function delete($id);
}