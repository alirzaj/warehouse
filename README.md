# warehouse
This is a warehouse software which holds articles and products.

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

## Importing data
This application provides two commands to import articles and products data.

Before using these commands, make sure your data files (e.g. articles.json) are available in storage/app directory of the application.

> **Note**
> These commands must be executed in the docker directory.

### *Articles*
You can import articles via this command:

``` bash
docker compose run --rm artisan articles:import
```

![articles-import-command](https://user-images.githubusercontent.com/56073296/196364326-aae26dab-d241-4807-912c-300de0ad9deb.png)

### *Products*
You can import products via this command:

``` bash
docker compose run --rm artisan products:import
```

![products-import-command](https://user-images.githubusercontent.com/56073296/196364866-fb18c23e-d945-4548-936c-01b2de69e35b.png)

## Database schema
Here is the schema of the application's database:

![schema](https://user-images.githubusercontent.com/56073296/196355417-b8c347ec-064c-43f8-ab67-5f2ebfd70475.png)

## Run tests

In order to run tests, execute the following command: (this command must be executed in the docker directory)

``` bash
docker compose run --rm artisan test
```

> **Note**
> It's better to have a separated database for testing.
> In order to keep things simple, this application provides you with a warehouse_test database out of the box which is used in the testing environment variables.
> If you want to run this application in an environment other than testing, then it's recommended to create a database and set its credentials in .env file.

## Useful links
In this application we have overridden the default query builder. you can read more about it in [this article](https://timacdonald.me/dedicated-eloquent-model-query-builders/).

you may see a directory called Actions. This is a simple pattern to make our code more re-usable and to have better testability. Read more about it in [this article](https://freek.dev/1371-refactoring-to-actions). 

## Issues

In the [issue board](https://github.com/alirzaj/warehouse/issues) of this project, there are two labels:
- [`investigate`](https://github.com/alirzaj/warehouse/issues?q=is%3Aissue+is%3Aopen+label%3Ainvestigate) is used for potential bugs.
- [`idea`](https://github.com/alirzaj/warehouse/issues?q=is%3Aissue+is%3Aopen+label%3Aidea) is used to document future improvements that could be applied.
