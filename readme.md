# School - Technical test

Install the dependencies and devDependencies and start the server.

```sh
$ composer install
$ npm install
```
Run the migrations:
```sh
$ php artisan migrate
```

Run the table seeders (dummy data):
```sh
$ php artisan db:seed
```

or simply:
```sh
$ php artisan migrate:refresh --seed
```

Start application
```sh
$ php artisan serve
```

Alternatively, import the `db.sql` file into phpmyadmin and reset the DB credentials in the `.env` file.


The app contains CRUD implementations for the following entities: Student, StudentClass, Teacher, Grade.

API endpoints are also available for listing/filtering the data:
 - [api/students](http://127.0.0.1:8000/api/students)
 - [api/teachers](http://127.0.0.1:8000/api/teachers)
 - [api/classes](http://127.0.0.1:8000/api/classes)
 - [api/grades](http://127.0.0.1:8000/api/grades)

and the special endpoints required:
 - [api/final-grade](http://127.0.0.1:8000/api/final-grade) [`student_id` parameter - required]
 - [api/average-grade](http://127.0.0.1:8000/api/average-grade) [`class_id` parameter - required]


