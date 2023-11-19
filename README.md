# Simple weather application

Simple weather application

## Installation

Install the composer dependencies:

```bash
composer install
```

Make a copy of the `.env.example` file named `.env`:
Make a copy of the `.env.testing.example` file named `.env.testing`:

```bash
cp .env.example .env
```

Generate an app key:

```bash
php artisan key:generate
```

Install all `package.json` dependencies:

```bash
npm install
```

Run vite to serve your assets/bundle:

```bash
npm run dev
```

Run migration on db, and test db

```bash
php php artisan migrate
php php artisan migrate --env=testing
```


Open a new terminal instance and serve the application:

```bash
npm run dev
php artisan serve

```
