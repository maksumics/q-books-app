<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\Http;

abstract class HttpRepository
{
    protected $apiUriBase;
    protected $apiTokenKey;

    abstract protected function getEntity();

    public function __construct()
    {
        $this->apiUriBase = env('APP_API_URI_BASE');
        $this->apiTokenKey = session('token_key');
    }

    public function setBaseUri($uri) {
        $this->apiUriBase = $uri;
    }

    public function setKey($key) {
        $this->apiTokenKey = $key;
    }

    public function list($page, $limit = 10, $order = 'id', $direction = 'ASC') {
        $data = [
            'limit'     => $limit ? $limit : 10,
            'order'     => $order ? $order : 'id',
            'direction' => $direction ? $direction : 'ASC',
            'page'      => $page
        ];
        try {
            $response = Http::withToken($this->apiTokenKey)->get($this->apiUriBase, $data);
        } catch (Exception $e) {
            return false;
        }
        return $response;
        
    }

    public function get($id) {
        if (!isset($id)) {
            return false;
        }
        try {
            $response = Http::withToken($this->apiTokenKey)->get($this->apiUriBase . '/' . $id);
        } catch (Exception $e) {
            return false;
        }

        if ($response && $response->successful()) {
            $class = $this->getEntity();
            return class_exists($class) ? new $class($response->json(), mapping: true) : false;
        } else {
            return [];
        }
    }

    public function add($data) {
        try{
            $response = Http::withToken($this->apiTokenKey)->post($this->apiUriBase, $data);
        } catch (Exception $e) {
            return false;
        }
        return $response->successful() ? $response->json() : false;
    }

    public function delete($id) {
        try {
            $response = Http::withToken($this->apiTokenKey)->delete($this->apiUriBase . '/' . $id);
        } catch (Exception $e) {
            return false;
        }

        return $response->successful();
    }
}
