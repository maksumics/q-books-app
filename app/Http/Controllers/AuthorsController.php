<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;

class AuthorsController extends Controller
{
    protected $service;
    public function __construct(AuthorService $service) {
        $this->service = $service;
    }

    public function index($page = 1) {
        $authors = $this->service->list($page, 10);
        return view('authors.list', ["authors" => $authors]);
    }

    public function get($id) {
        $author = $this->service->get($id);
        return view('authors.detail', ["author" => $author]);
    }

    public function delete($id) {
        $this->service->delete($id);
        return redirect()->back();
    }
}
