# ISP Inventory Management System

A web-based inventory system for tracking network devices (routers, switches, ONUs) for the ISP section of a network company.
It replaces paper stock sheets with a database, so stock, usage and faulty-device reports are generated automatically.

> Status: in development (Build 2 of 10). All data in this repository is dummy data.

## Features

Done:

- Project skeleton, database connection (PDO), shared layout
- Products: list and add (with validation, duplicate protection)

Planned:

- Products edit/delete, organizations, devices
- Usage and device issue, faulty devices, router transactions
- Login with roles, dashboard, stock report, print view with signature lines

## Tech stack

| Layer    | Technology                             |
| -------- | -------------------------------------- |
| Frontend | HTML, CSS, JavaScript                  |
| Backend  | Raw PHP 8.2 (PDO, prepared statements) |
| Database | MySQL / MariaDB                        |
| Server   | Apache (XAMPP)                         |

## How it works

Browser -> Apache -> PHP -> MySQL. PHP reads or writes data through PDO and returns finished HTML.

## Folder structure

```
config/          app.php (BASE_URL), db.php (database connection)
includes/        header.php, footer.php (shared layout)
products/        list.php, add.php
devices/         (planned)
organizations/   (planned)
assets/css/      style.css
lessons/         learning practice files (not part of the app)
```

## Run locally

1. Install XAMPP and start Apache and MySQL.
2. Copy this folder to `xampp/htdocs/isp_inventory_management`.
3. In phpMyAdmin create a database named `isp_inventory`, then import `database.sql`.
4. Check the settings in `config/db.php` (default: user `root`, empty password).
5. Open `http://localhost/isp_inventory_management/`.

## Roadmap

1. Skeleton, connection, layout (done)
2. Products list and add (done)
3. Products edit and delete
4. Organizations
5. Devices
6. Usage and issue (transactions)
7. Faulty devices and router transactions
8. Login and roles
9. Dashboard and stock report
10. Print view, testing, documentation

## Author

Tahsin Akter Roza, intern project.
