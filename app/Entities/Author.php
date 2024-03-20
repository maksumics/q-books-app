<?php

namespace App\Entities;

class Author
{
    public $id;
    public $firstName;
    public $lastName;
    public $birthday;
    public $gender;
    public $placeOfBirth;
    public $books;

    public function __construct($id, $firstName, $lastName, $birthday, $gender, $placeOfBirth, $books = [])
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthday = date('d-m-Y', strtotime($birthday));
        $this->gender = $gender;
        $this->placeOfBirth = $placeOfBirth;
        $this->books = collect($books)->map(function ($book) {
            return new Book($book['id'], $book['title'], $book['release_date'], $book['description'], $book['isbn'], $book['format'], $book['number_of_pages'], $this);
        });
    }
}
