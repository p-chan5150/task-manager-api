# Laravel Task Manager Api

## Local Setup (MySql)

- Clone the git repository and cd into repo folder

```bash
git clone https://github.com/p-chan5150/task-manager-api.git

cd task-manager-api

composer install
```

- Copy .env example and rename to .env
- Uncomment and configure your MySql credentials from the following fields

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=your_password
```

- Run migrations and populate the database

```bash
php artisan db:seed
```

- Start the server

```bash
php artisan serve
```

## Usage and Requests

- POST /api/tasks

include id to return a specific task

```bash
http://127.0.0.1:8000/api/tasks

http://127.0.0.1:8000/api/tasks/56
```

- GET /api/tasks

```bash
http://127.0.0.1:8000/api/tasks?status=pending
```

- PATCH /api/tasks/{id}/status

```bash
http://127.0.0.1:8000/api/tasks/45/status
```

- DELETE /api/tasks/{id}

```bash
http://127.0.0.1:8000/api/tasks/67
```

- GET /api/tasks/report?date=YYYY-MM-DD

```bash
http://127.0.0.1:8000/api/tasks/report?date=2026-03-31
```

- `http://localhost:8000/docs/api`
  To view api documentation

## Deployment

- Push the project to a github repository
- Sign up to railway or any hosting site of your choice
- Setup a database server
- Import the project repository
- Setup environment variables in line with the database

```bash
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
APP_NAME=
APP_ENV=
APP_KEY=
APP_URL=
```

- Setup build command and start command

```bash
composer install --no-dev --optimize-autoloader

php artisan migrate:fresh --seed && php artisan serve --host 0.0.0.0 --port 8000
```

- Deploy

# Troubleshooting

- Set persist environment php version as 8.4
