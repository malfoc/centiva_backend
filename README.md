
# Centiva Test Laravel backend

Laravel application that allows to evaluate the quality of the code, meet the requirements with attention to detail.

This application contains access to four GET endpoints, one POST endpoint and one DELETE endpoint.


## Technologies

||Version|Command for checking
|-|-:|-|
|php|8.1|php --version|
|mysql|8.0.28|mysql --version|
|laravel|9.52.4|php artisan --version|
|git|2.39.2|git --version|

## Setup

- The `ApiResponse` trait is created to standardize API responses.

- The following lines are modified in the `app/Providers/RouteServiceProvider.php` file:

    - `Route::middleware('web')->group(base_path('routes/web.php'));` is removed because the system is a RESTful API and access to Laravel's web version is not required.
    - The route for API access is modified by removing the route prefix to establish direct access to the route endpoints without the need for a prefix in the call.

- The `render` method is added to the `app/Exceptions/Handler.php` file to intercept exceptions and apply the ApiResponse trait.
## Deployment

To deploy this project run

```bash
  composer install
```

Populate the database run

```bash
php artisan migrate --seed --seeder=TeamSeeder
```



## API Reference

#### Get all teams

```http
  GET /teams
```

- Return all teams
- For each team, return the team name and the list of members it contains

#### Get a team

```http
  GET /team/${id}
```

- Possibility to pass a team ID as a parameter to filter the search
- For each team, return the team name and the list of members it contains

#### Delete a team

```http
  DELETE /teams/${id}
```

- Allowing to soft-deleter a team.

#### Get all members

```http
  GET /members
```

- Return all members
- For each member, know to which team he belongs

#### Get a member

```http
  GET /member/${id}
```

- Ability to pass a member ID as a parameter to filter the search
- For each member, know to which team he belongs

#### Create a team

```http
  POST /members
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `fullname` | `string` | Fullname's member |
| `email` | `string` | **Unique** email address |
| `team_id` | `integer` | Must be a id valid |

- Creating a new team member.


## Running Tests

To run tests, run the following command

```bash
  php artisan test
```


## Additional Features

At least one of the following concepts should be used for a project feature demo.

- Events + Listeners
- Observers
- Queues
- Mailables (chosen)

From the project feature in which there is a POST endpoint to register team members, Mailable was taken to send a welcome notification when a user is registered

*Implementation File*: `app/Models/Member.php`

```php
protected static function boot()
{
    parent::boot();

    static::created(function ($member) {
        Mail::to($member->email)->send(new NewMemberNotification($member));
    });
}
```