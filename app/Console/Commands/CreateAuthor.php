<?php

namespace App\Console\Commands;

use App\Entities\Author;
use Illuminate\Console\Command;
use App\Services\AuthorService;
use Illuminate\Support\Facades\Http;

class CreateAuthor extends Command
{
    const BASE_URI = 'https://symfony-skeleton.q-tests.com/api/v2';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'author:create {--authKey=} {--firstName=} {--lastName=} {--birthday=} {--biography=} {--gender=} {--birthPlace=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $service;
    
    public function __construct(AuthorService $service) {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("--------------------------------------------------------------------------------
        \n--------------------------------------------------------------------------------
        \n--------------------------Q-BOOKS-AUTHOR-CREATION-------------------------------
        \n--------------------------------------------------------------------------------
        \n--------------------------------------------------------------------------------\n");
        $token = $this->option('authKey');
        if (empty($token)) {
            $this->info("No authorization key provided, moving to standard autentification, please provide credentials...\n");
            $email = $this->ask('Email');
            $password = $this->secret('Password');

            $data = [
                'email' => $email,
                'password' => $password
            ];

            $response = Http::post(self::BASE_URI . '/token', $data);

            if ($response->successful()) {
                $token = $response['token_key'];
            } else {
                $this->error('Cannot login');
                return;
            }
        }

        $this->service->setKey($token);
        $this->service->setBaseUri(self::BASE_URI . '/authors');

        $birthday = date_create_from_format('d-m-Y', $this->option('birthday'));
        $birthday = $birthday ? $birthday->format('d-m-Y') : null;
        
        $firstName = $this->option('firstName');
        $lastName = $this->option('lastName');
        
        $biography = $this->option('biography');
        $gender = $this->option('gender');
        $birthPlace = $this->option('birthPlace');

        if (!$firstName || !$lastName || !$gender || !$birthPlace || !$birthday) {
            $this->error('Validation error!');
            return;
        }

        $author = new Author();
        $author->firstName = $firstName;
        $author->lastName = $lastName;
        $author->gender = $gender;
        $author->birthday = $birthday;
        $author->placeOfBirth = $birthPlace;
        $author = $this->service->create($author);
        if ($author) {
            $this->info(sprintf("Author %s %s successfuly created with an id %d. Clossing command!", $author['first_name'], $author['last_name'], $author['id']));
        } else {
            $this->error('Error while creating an author!');
            return;
        }
    }
}
