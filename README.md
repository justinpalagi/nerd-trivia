# Nerd Trivia

This is a web accessible nerd trivia application. It is built to integrate with several nerdy API's or data sources to generate categorized questions for a trivia game.

The main purpose for the writing of this application was:

- Learn the basics of the Laravel Framework
- Practice SOLID design Prinicipals

## Trivia Rules

The game is currently hard coded to 2 rounds of 3 questions all randomly generated.

In order to gain points the participant must submit the correct answer within 60 seconds. How quickly the particpant answers will determine the final score using the following conversion.

- ***10 seconds or less:*** 6 points
- ***11-20 seconds:*** 5 points
- ***21-30 seconds:*** 4 points
- ***31-40 seconds:*** 3 points
- ***41-50 seconds:*** 2 points
- ***51-60 seconds:*** 1 points


Anything else and an incorrect answer will result in no points.

## Getting Started

Run the following commands from within the project directory.

Install all project dependencies.

```
composer install
```

Make a copy of the .env file for your local machine.

```
cp .env.example .env
```

Within the new `.env` file set the following properties.

```
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Generate an app key.

```
php artisan key:generate
```

Run the migration scripts to generate the database tables. Prior to running the migration the database will need to be created within the target mysql environment.

```
php artisan migrate
```

Create Passport encryption keys.

```
php artisan passport:install
```

Start the projet.

```
php artisan serve
```

## API

---

### Create Game

`GET /game`

#### Response

This returns a single code that can be used to join the game as a participant.

---

### Join Game

`POST /game/{gameCode}/participant`

The gameCode variable should be replaced with the code returned from creating a new game.

This call will create a participant in the game and corresponding API access token used for getting questions and submitting answers.

#### Request

```
{
  "name": "Display name of Participant"
}
```
#### Response

```
{
    "access_token": "ReallyLongAccessToken",
    "token_type": "Bearer",
    "expires_at": "2020-02-04 20:33:48"
}
```
---
### Get Question

`GET /question`

#### Request

The request must include the following header.

```
Authorization Bearer {access_token}
```

#### Response

```
{
    "question": "Who was Cersei Lannister's younget son?",
    "category": "got",
    "game_id": 19,
    "start_time": "2020-02-04T19:37:57.953010Z",
    "question_id": 20
}
```
---
### Submit Answer

`POST /question/{question_Id}/answer`

#### Request

The request must include the following header.

```
Authorization Bearer {access_token}
```
Body

```
{
	"answer" : "Tommen Baratheon"
}
```

#### Response

No data is returned in the response.

---

## Design Questions

This isn't a practical API for a trivia game because it is all Request-Response as opposed to Event Driven. An event driven design approach would allow participants to subscribe to an event channel and listen for new questions. 

The Eloquent models would also be a candidate for interfaces because at the moment the entire project highly depends on those models and replacing Eloquent with a different ORM solution would be a major breaking change.

There is also potential for some confusion around when to use the Repository vs. the Business Logic from the Controller. A better approach to handling this could be injecting just the Business Logic into the controller and using it for queries and updates. This however brought up the question of how to inject an interface into an injected class and I was not sure how Laravel handled that.

## What's Missing

- Unit/Integration Testing
- Logging Configuration
- Unauthorized Redirect Location
- Global Error Handling
- Consistent API reponse data
- Environment or global scoping of variables like rounds and questions per round
- A way to register categories rather than hard code the list
- A better randomization library. The current random functions tend to come up with the same questions/category ordering the majorty of the time.
- UI

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
