<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use Illuminate\Http\Request; 

class AuthorsController extends Controller
{
    protected $service;
    public function __construct(AuthorService $service) {
        $this->service = $service;
    }

    public function index(Request $request) {
        $page = $request->query('page', 1);
        $result = $this->service->list($page, 10);
        return view('authors.list', ["data" => $result]);
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
