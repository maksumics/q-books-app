<?php

namespace App\Entities;

class Author extends Entity
{

    protected $fieldMap = [
        'id' => 'id',
        'first_name' => 'firstName',
        'last_name' => 'lastName',
        'birthday' => 'birthday',
        'biography' => 'biography',
        'gender' => 'gender',
        'place_of_birth' => 'placeOfBirth',
        'books' => 'books'
    ];

    public $id;
    public $firstName;
    public $lastName;
    public $birthday;
    public $gender;
    public $placeOfBirth;
    public $books = [];

    protected function preProcessField($name, &$value) {
        switch($name) {
            case 'books':
                $books = [];
                foreach ($value as $item) {
                    $books[] = new Book($item, mapping: true);
                }

                return $books;
                break;
            case 'birthday':
                return date('d-m-Y', strtotime($value));
                break;
            default:
                return $value;
                break;
        }
        
    }
}
