

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

