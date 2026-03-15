# Workout Tracker

🇺🇸 English | 🇧🇷 [Leia em Português](README.md)

Workout Tracker is a project initially focused on the backend for workout management, allowing users to create workout plans, schedule exercises, and track their progress over time.

The project is developed incrementally to simulate how real systems evolve — starting with a minimal API and gradually evolving into a scalable full-stack application.

---

## Summary

* [Project Goals](#project-goals)
* [Main Features](#main-features)
* [Technologies Used](#technologies-used)
* [Running the Project](#running-the-project)
* [API Documentation](#api-documentation)
* [Tests](#tests)
* [Project Versions](#project-versions)

---

## Project Goals

This project aims to practice important software engineering concepts:

* REST API design
* Authentication and security
* Relational database modeling
* Software architecture
* System scalability
* API documentation
* Automated testing

---

## Main Features

### Authentication

Users can:

* Create an account
* Log in
* Access protected endpoints using JWT

Requests must include:

```
Authorization: Bearer <token>
```

---

### Exercise Database

Exercises are preloaded using seeders.

Each exercise contains:

* Name
* Description
* Category
* Muscle group

---

### Workout Plans

Users can create workout plans composed of multiple exercises.

Each exercise includes:

* Number of sets
* Number of repetitions
* Weight used

Users can:

* Create workouts
* Edit workouts
* Delete workouts
* List workouts

---

### Workout Scheduling

Users can schedule workouts for specific dates and times.

Scheduled workouts can be listed in chronological order.

---

### Progress Reports

The system can generate reports based on completed workouts.

Reports include:

* Workout history
* Exercise progress
* Training frequency

---

## Technologies Used

### Backend

* Laravel
* PostgreSQL
* JSON Web Tokens (JWT)

### Infrastructure

* Docker

### Frontend (future versions)

* React
* Tailwind CSS
* Redux
* Jest

### Advanced Infrastructure (future versions)

* Redis
* RabbitMQ
* Nginx
* MinIO

---

## Running the Project

This project uses Docker to ensure consistency across development environments.

### Requirements

* Docker
* Docker Compose

### Clone the repository

```
git clone https://github.com/Caca404/workout-tracker.git
cd workout-tracker
```

### Configure environment variables

```
cp .env.example .env
```

### Start containers

```
docker compose up -d --build
```

### Install dependencies

```
docker compose exec app composer install
```

### Generate Laravel key

```
docker compose exec app php artisan key:generate
```

### Run migrations

```
docker compose exec app php artisan migrate
```

### Seed the database with exercises

```
docker compose exec app php artisan db:seed
```

### Start Laravel

```
docker compose exec app php artisan serve --host=0.0.0.0 --port=8000
```

The API will be available at:

```
http://localhost:8000
```

---

## API Documentation

The API is documented using OpenAPI.

The documentation will be available at:

```
/docs
```

---

## Tests

To run the tests:

```
docker compose exec app php artisan test
```

---

## Project Versions

### Version 1 — Backend MVP

The first version focuses on implementing the API required to meet the project requirements.

Features:

* User registration
* Login with JWT authentication
* Exercise database with seeders
* Workout plan CRUD
* Workout scheduling
* Progress reports
* REST API
* OpenAPI documentation (Swagger)
* Unit tests with Pest

Infrastructure:

* Docker
* PostgreSQL

---

### Version 2 — Frontend Application

In this version, a complete user interface is added.

Stack:

* React
* Tailwind CSS
* Redux
* Jest

Features:

* Authentication interface
* Workout creation
* Exercise selection
* Workout scheduling
* Progress dashboard
* Workout calendar
* User profile with physical metrics

---

### Version 3 — Performance and Infrastructure

This version introduces infrastructure and performance improvements.

New components:

* Redis for caching
* RabbitMQ for background processing queues
* Nginx as a web server

Examples of usage:

Cache:

* Exercise list
* Workout reports
* Scheduled workouts

Queues:

* Email sending
* Report generation
* Analytical data processing

---

### Version 4 — File Storage

In this version the system starts supporting file uploads.

New component:

* MinIO

Capabilities:

* User profile pictures
* Exercise-related media