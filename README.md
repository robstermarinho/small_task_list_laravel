# Scopic Task List App

This is a small task list application in Laravel that allow users to authenticate, create a list of tasks and perform CRUD operations. Additionally, it has small role-based access control. This app provides:

  - list of tasks, add, edit and delete items
  - change state of task (AJAX)
  - role based access control: admin|regular
  - admin user has total control
  - XML and XML export
## Getting Started

Create a `.env` file in the root directory of your project. Add
environment-specific variables to connect the database and email settings.
For example:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=scopic_task_list
DB_USERNAME=root
DB_PASSWORD=mypassword

MAIL_DRIVER=mail
MAIL_HOST=smtp.mandrillapp.com
MAIL_PORT=587
MAIL_USERNAME=myuser@gmail.com
MAIL_PASSWORD=mypassword
```

### Install migration and seed

This App provides some migrations and seed for user and task tables.
Run the following command in the root directory of your project to create the tables on the database and seed them.

```sh
php artisan migrate --seed
```

The simplest way to start a server is:

```sh
php artisan serve
```

Verify the deployment by navigating to your server address in your preferred browser.

```sh
127.0.0.1:8000
```
