

## Q Books Test App

This exam application is built using Laravel framework, with Sail plugin for dockerization of the app.

## Requirements

- Docker installed

## Project setup
- For Windows users: go to WSL command line
- Clone repository: ``` git clone ```
- Change to project directory ``` cd q-books-app ```.
- Run application setup mini script ``` ./app-setup ```.
- After script is done, application shloud be available trough exposed port 80 ``` http://localhost/ ```.
- If your local docker setup does not have ``` sail-8.3/app ``` image builded, then process of first time building can take up to 20 mins
- For next running, regular docker procedure is enaugh (start from Docker desktop, or ``` docker compose up ```)

## Authors creation command

This command (``` author:create ```) will create a new author builded up from command arguments

Example of command execution:
- In case of running from project directory
``` ./vendor/bin/sail artisan author:create --firstName="Senaid" --lastName="Maksumic" --birthPlace="Mostar" --birthday="04-03-1996" --gender="male" ```

- In case of running from container shell
``` php artisan author:create --firstName="Senaid" --lastName="Maksumic" --birthPlace="Mostar" --birthday="04-03-1996" --gender="male" ```

- After running, if ``` authKey ``` argument is not passed, you will be promted for the login data. If login was successful, and if all required fields are present and valid, you'll be notified about newly created author.
   In case of some errors, process exits.
- ``` authKey ``` argument is left here in case of this script will be used from cron / scheduling part, to be able to abstract authentification.
