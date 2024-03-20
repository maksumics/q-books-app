<?php

namespace App\Entities;


class Book
{
    protected $fieldMap = [
        'id' => 'id',
        'title' => 'title',
        'releaseDate' => 'release_date',
        'description' => 'description',
        'isbn' => 'isbn',
        'format' => 'format',
        'pageNumbers' => 'number_of_pages'
    ];

    public function getFieldMap() {
        return $this->fieldMap;
    }

    public $id;
    public $title;
    public $releaseDate;
    public $description;
    public $isbn;
    public $format;
    public $pageNumbers;
    public Author $author;

    public function __construct($id, $title, $releaseDate, $description, $isbn, $format, $pageNumbers, $author = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->releaseDate = date('d-m-Y', strtotime($releaseDate));
        $this->description = $description;
        $this->isbn = $isbn;
        $this->format = $format;
        $this->pageNumbers = $pageNumbers;
        $this->author = $author;
    }
}
