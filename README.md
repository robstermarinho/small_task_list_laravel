# Scopic Task List App

This is a small task list application in Laravel that allows users to authenticate, create a list of tasks and perform CRUD operations. Additionally, it has a small role-based access control. This app provides some features:

  - A list of tasks, add, edit and delete items
  - Change state of the task (AJAX)
  - Role-based access control: admin|regular
  - Admin user has total control
  - Exporting the list to XML and XML
## Getting Started

### Install components
Run the following command in the root directory of your project to install all components needed to the application:

```sh
composer update
```

Create a `.env` file in the root directory of your project. Add some
environment-specific variables like APP_KEY, database connection and email settings.
For example:

```
APP_KEY=

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=scopic_task_list
DB_USERNAME=root
DB_PASSWORD=mypassword

MAIL_DRIVER=mail
MAIL_HOST=smtp.mandrillapp.com
MAIL_PORT=587
MAIL_USERNAME=yourusername@gmail.com
MAIL_PASSWORD=yourpassword
```
Generate a new APP_KEY:

```sh
php artisan key:generate
```
### Install migration and seed

This App provides some migrations and seed the tables user and task.
Run the following command in the root directory of your project to create the tables on the database and seed them.

```sh
php artisan migrate --seed
```
The seeding provides two pre-configured users and some already created tasks. You can logging in the application using one of the following users:

| User | Role | Password
| ------ | ------ | ------ |
| admin@scopic.com | admin | 123456 |
| robstermarinho@gmail.com | regular | 123123 |


The simplest way to start a server is:

```sh
php artisan serve
```

Verify the deployment by navigating to your server address in your preferred browser.

```sh
127.0.0.1:8000
```
