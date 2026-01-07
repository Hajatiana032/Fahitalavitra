# Fahitalavitra

Fahitalavitra is a movie management application built with Laravel and Filament. It allows users to browse movies from
the TMDB (The Movie Database) API and import them into a local collection with ease.

## Stack

- **Language:** PHP 8.2+
- **Framework:** [Laravel 12](https://laravel.com)
- **Admin Panel:** [Filament 4](https://filamentphp.com)
- **Frontend:
  ** [Livewire](https://livewire.laravel.com), [Tailwind CSS 4](https://tailwindcss.com), [Vite](https://vitejs.dev), [FlyonUI](https://flyonui.com)
- **Package Managers:** Composer (PHP), NPM (JavaScript)
- **Database:** MySQL/SQLite (configured in `.env`)

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- A database (MySQL, SQLite, etc.)

## Setup & Installation

1. **Clone the repository:**
   ```bash
   git clone <repository-url>
   cd fahitalavitra
   ```

2. **Environment Setup:**
   Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
   *Note: On Windows PowerShell, use `copy .env.example .env`.*

3. **Run the automated setup script:**
   This project includes a comprehensive setup script via Composer that handles dependencies, environment, and database
   initialization:
   ```bash
   composer run setup
   ```
   This script performs:
    - `composer install`
    - Creates `.env` from `.env.example` (if missing)
    - `php artisan key:generate`
    - `php artisan migrate --force`
    - `npm install`
    - `npm run build`

4. **TMDB API Configuration:**
   Obtain a Bearer Token from [The Movie Database (TMDB)](https://www.themoviedb.org/settings/api) and add it to your
   `.env` file:
   ```env
   API_KEY=your_tmdb_api_bearer_token_here
   ```

## Running the Application

To start the development environment (local server, queue worker, and Vite dev server) simultaneously:

```bash
composer run dev
```

Alternatively, you can run services separately:

- **Artisan Server:** `php artisan serve`
- **Queue Worker:** `php artisan queue:listen`
- **Vite (Hot Module Replacement):** `npm run dev`

**Entry Point:** Access the admin panel at [http://localhost:8000/admin](http://localhost:8000/admin).

## Scripts

### Composer Scripts

- `composer run setup`: Full project initialization.
- `composer run dev`: Starts the development server, queue listener, and Vite using `concurrently`.
- `composer run test`: Clears config and runs the test suite.

### NPM Scripts

- `npm run dev`: Starts the Vite development server.
- `npm run build`: Compiles assets for production.

## Environment Variables

- `API_KEY`: TMDB API Bearer token (required for movie imports).
- `DB_CONNECTION`: Database driver (e.g., `mysql`, `sqlite`).
- `DB_DATABASE`: Database name.
- Standard Laravel environment variables (see `.env.example`).

## Tests

The project uses [Pest](https://pestphp.com) for testing.

```bash
composer run test
```

## Project Structure

- `app/Filament/Resources`: Filament resource definitions (Admin CRUD).
- `app/Livewire`: Livewire components (e.g., `MoviesTmdb` for TMDB API integration).
- `app/Models`: Eloquent models (e.g., `Movie`).
- `app/Providers/Filament`: Filament panel configurations.
- `database/migrations`: Database schema definitions.
- `resources/views`: Blade templates and Livewire views.
- `routes/web.php`: Web routes and application entry points.
- `vite.config.js`: Vite asset bundling configuration.

## TODOs

- [ ] Add documentation for user roles and permissions.
- [ ] Implement more TMDB endpoints (TV shows, actors, etc.).
- [ ] Increase test coverage for Livewire components and Filament actions.
- [ ] Configure CI/CD pipeline (e.g., GitHub Actions).

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
