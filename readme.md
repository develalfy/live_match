## Installation

To install the project just follow this:-

- `git clone git@github.com:develalfy/live_match.git`
- go to root folder `cd live_match`
- create database with the name you need
- `cp .env.example .env`
- edit `.env` with your data.
- `composer install`
- `php artisan migrate`
- `php artisan db:seed`
- Don't forget to give permissions to storage and cache `chmod -R 777 storage bootstrap/cache`
- generate new keys `php artisan key:generate`
- to install npm modules `npm install`
- make sure to have node and redis installed
- run `redis-server`
- run `node socket.js`

## Live demo
http://elalfi.me/live_match/public/

Notes:-
Admin basic credentials:- as seeded
- email: admin@site.com
- password: 123456