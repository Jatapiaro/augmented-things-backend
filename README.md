# Augmented Things Backend

This is the main repository for the Augmented Things backend.

## Instalation Project 

1. Clone the repository.

2. Navigate to the created folder.
```shell
$ cd folder
```

3. Define your enviroment variables
```shell
$ cp .env.example .env
```

4. Define the configurations in your .env file
```shell
$ vi .env
```

5. Install the composer requirements
```shell
$ composer install
```

6. Install yarn (only if it is not installed in your system)
```shell
$ npm install -g yarn
```

7. Install the node dependencies
```shell
$ yarn install install
```

8. Generate the artisan keys
```shell
$ php artisan key:generate
```

9. Install passport
```shell
$ php artisan passport:install
```

10. Execute the migrations and the _seeds_
```shell
$ php artisan migrate
$ php artisan db:seed
```

## Testing

Documentation is pending

