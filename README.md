# warehouse
This is a warehouse software which holds articles with products.

Using this application you can see a list of products and quantities of each.

Note that the products are ordered by **maximum profit**.

## How to use this application?
To run this application you need the following dependencies:

- `PHP 8.1+`
- `composer 2.x`
- `MySQL 8.0+`

This application is packaged with Docker out of the box. so if you have Docker installed on your machine, you can follow the below instructions to get things up and running.
### *Step 1: Copy .env.example*

Go to you terminal in the project's root directory and run the following command:

``` bash
cp .env.example .env
```

### *Step 2: Go to docker directory*

All the docker commands must be run in the docker directory.

``` bash
cd docker
```

### *Step 3: Install the dependencies*

Run this command to install all the dependencies using composer.

``` bash
docker compose run --rm composer install
```

### *Step 4: Generate you application key*

In order to run this application, a key must be provided. this command will generate the key and put it in your .env file.

``` bash
docker compose run --rm artisan key:generate
```

### *Step 5: Run the necessary containers*

Using this command, you can start the necessary containers to run the application.

``` bash
docker compose up mysql app -d
```

### *Step 6: Migrate the tables*

At last, you need to run this command in order to create the tables in database.

``` bash
docker compose run --rm artisan migrate
```
