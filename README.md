

## The project
A simple API created using Laravel to manage movies, ratings and people related to the movies.
 
## How to install

 1. Create a copy of `.env.example` and rename it to `.env`, then set up
    your MySQL data on it.
   
 2. Using docker, you can use Laravel Sail to build the application. Just run `./vendor/bin/sail up`. 
 **Note:** I highly recommend you to use [Laravel Sail](https://laravel.com/docs/8.x/installation). It's a very easy and Docker way to setup a Laravel application and run the project.
3. Fill the database with our data, just use `php artisan migrate:refresh --seed`to run all migrations and seed all the information.

## Available endpoints
### Movies

```http
GET /api/movies
```

```http
POST /api/movies
```

| Parameter  | Description |
| ------------- | ------------- |
| `name`  | **Required** string |
| `year` | *Optional* integer |
| `sinopse`  | *Optional* text |
| `duration`  | *Optional* string |
| `image`  | *Optional* string |

```http
PUT /api/movies/{id}
```

| Parameter  | Description |
| ------------- | ------------- |
| `name`  | **Required** string |
| `year` | *Optional* integer |
| `sinopse`  | *Optional* text |
| `duration`  | *Optional* string |
| `image`  | *Optional* string |

```http
DELETE /api/movies/{id}
```

### Ratings

```http
GET /api/ratings
```

```http
POST /api/ratings
```

| Parameter  | Description |
| ------------- | ------------- |
| `movie_id`  | **Required**. integer |
| `rating` | *Optional*. integer |
| `comment`  | *Optional*. text |

```http
PUT /api/ratings/{id}
```

| Parameter  | Description |
| ------------- | ------------- |
| `movie_id`  | **Required**. integer |
| `rating` | *Optional*. integer |
| `comment`  | *Optional*. text |

```http
DELETE /api/movies/{id}
```

### Person

```http
GET /api/person
```

```http
POST /api/person
```

| Parameter  | Description |
| ------------- | ------------- |
| `name`  | **Required**. string |
| `date_of_birth` | *Optional*. string |
| `image`  | *Optional*. string |

```http
PUT /api/person/{id}
```

| Parameter  | Description |
| ------------- | ------------- |
| `name`  | **Required**. string |
| `date_of_birth` | *Optional*. string |
| `image`  | *Optional*. string |

```http
DELETE /api/person/{id}
```
