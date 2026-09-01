# Awesome eStore

An online shop on CodeIgniter 4.7. It began life as a CodeIgniter 3 application; that
version is still in this repository's history, up to commit `15880df`.

## Requirements

* PHP 8.2 or newer, with the `intl`, `mbstring` and `mysqli` extensions
* MySQL 5.7 / MariaDB 10.3 or newer
* Composer

## Setup

```bash
composer install

cp env .env          # then edit it, see the ONLINE SHOP block at the bottom
```

At minimum set the database name, user and password, and the base URL:

```
app.baseURL = 'http://localhost:8080/'
app.indexPage = ''

database.default.database = online_shop
database.default.username = root
database.default.password = ''
```

Create the database, then build the schema:

```bash
php spark migrate
php spark db:seed AdminSeeder      # one admin account, password from ADMIN_PASSWORD
```

To also load the catalogue carried over from the old application (35 products,
21 categories, sample orders and messages):

```bash
php spark db:seed DemoDataSeeder   # every demo account's password is: password123
```

Run it:

```bash
php spark serve
```

Point your web server's document root at `public/`. Never expose the project root.

## Layout

```
app/
  Config/Routes.php     every URL, explicitly - auto routing is off
  Controllers/          Shop, ProductApi, Account, User, Cart, Review, Admin
  Entities/             one per table: casts, mutators, small helpers
  Models/               queries, validation rules and callbacks
  Filters/AuthFilter    route level access control ("auth", "auth:user", "auth:admin")
  Libraries/Auth        the only thing that reads or writes the login session
  Database/Migrations/  the schema, one migration per table
  Database/Seeds/       AdminSeeder (real installs), DemoDataSeeder (the old catalogue)
  Views/
public/
  style/  uploads/      assets and product pictures, moved out of the project root
```

## What changed from the CodeIgniter 3 version

**Schema.** Tables are now plural with an `id` primary key: `user_table` → `users`,
`product_table` → `products`, `product_cart_table` → `cart_items`, and so on. The
schema lives in migrations instead of a hand-maintained SQL dump, and it now has
real foreign keys, so orphaned carts and images cannot happen any more.

Three columns changed meaning:

| Before | Now | Note |
|---|---|---|
| `product_table.active_flag` (0 = on sale) | `products.is_active` (1 = on sale) | the polarity was inverted |
| `cart_table.date_buy` + `flag` | `carts.ordered_at` | `NULL` = still an open cart |
| `contact_table.flag` | `contact_messages.is_read` | |

`cart_items` has a unique key on `(cart_id, product_id)`, so adding a product that
is already in the cart raises its quantity instead of adding a second line.

**Models and entities.** Each table has a `CodeIgniter\Model` holding its queries,
`$allowedFields`, validation rules and messages, and an entity holding its casts and
behaviour. Booleans come back as booleans, prices as floats and dates as `Time`
objects. `$useTimestamps` fills `created_at` / `updated_at`.

**Authentication.** Session handling moved out of the models into `App\Libraries\Auth`
and `App\Filters\AuthFilter`. The session id is regenerated on login, the old session
is destroyed (`session.regenerateDestroy`), and access is enforced on the route rather
than by a call at the top of each controller method, so a new action cannot forget it.
Passwords are hashed by a `beforeInsert`/`beforeUpdate` callback on `UserModel`, which
runs after validation, so the confirmation field is still checked against the plain text.

**Other.** CSRF protection is on for every POST. Views escape their output with `esc()`.
Flash messages are plain text rendered by `app/Views/layout/_alerts.php`, instead of
HTML assembled inside controllers and models.

## Notes

* Product descriptions are rich text written by the admin through CKEditor and are
  rendered unescaped on the product page. Only administrators can write them.
* `DemoDataSeeder` empties the tables it loads before inserting, so it is safe to
  re-run, and it will drop anything else you had in them.
