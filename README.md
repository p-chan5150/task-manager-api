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
php artisan db:seed --class=TasksSeeder
```

- Start the server

```bash
php artisan serve
```

## Usage and Requests

- POST /api/tasks

```bash
http://127.0.0.1:8000/api/tasks
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
