<?php

namespace App\Entities;


class Book extends Entity
{
    public $id;
    public $title;
    public $releaseDate;
    public $description;
    public $isbn;
    public $format;
    public $pageNumbers;
    public Author $author;

    protected $fieldMap = [
        'id' => 'id',
        'title' => 'title',
        'release_date' => 'releaseDate',
        'description' => 'description',
        'isbn' => 'isbn',
        'format' => 'format',
        'number_of_pages' => 'pageNumbers'
    ];

    protected function preProcessField($name, &$value) {
        switch($name) {
            case 'releaseDate':
                return date('d-m-Y', strtotime($value));
                break;
            default:
                return $value;
                break;
        }
        
    }
}
