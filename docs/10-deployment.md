# Deployment Guide — Plesk (Git-based)

This project is a Laravel app. `.gitignore` deliberately excludes files that are either
secret (`.env`), regeneratable (`vendor/`, `node_modules/`), or environment-specific
(`storage/*.key`, uploads, `DBBackup/`). Because of that, pulling the repo alone is not
enough to run the site — follow the steps below in order every time you set up a new
environment (first deploy or a new server).

## 0. Prerequisites on the server

- PHP 8.0+ (matches `"php": "^8.0"` in `composer.json`)
- MySQL/MariaDB database created, with a dedicated DB user
- Composer available (Plesk usually offers this under the domain's "Composer" tool, or
  via SSH)
- Node.js + npm only if you intend to rebuild front-end assets on the server (usually
  not needed — see step 5)

## 1. Add the Git repository in Plesk

- Domain → **Git** → paste the repo URL (`https://github.com/danielchoo1021/josephineNewDemoQC.git`)
- Since the repo is **private**, Plesk will ask for credentials or a deploy key —
  use a GitHub **Personal Access Token** (not your GitHub password) or an SSH deploy key
- Set the deployment mode to pull from `main`
- Point the document root to `public/` (Laravel's actual web root — not the repo root)

## 2. Create `.env` on the server

There is no `.env` in the repo (by design). Copy `.env.example` to `.env` on the server
and fill in **production** values — do not reuse your local `.env`:

```
APP_NAME=<site name>
APP_ENV=production
APP_KEY=            # leave blank, generated in step 4
APP_DEBUG=false      # never true in production
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<db name created in Plesk>
DB_USERNAME=<db user created in Plesk>
DB_PASSWORD=<db password>
```

Fill in mail/AWS/Pusher values only if those features are actually used in production.

## 3. Install PHP dependencies

Via SSH (or Plesk's Composer tool) in the project root:

```bash
composer install --no-dev --optimize-autoloader
```

`--no-dev` skips testing/dev-only packages; `--optimize-autoloader` speeds up class loading.

## 4. Generate the application key

```bash
php artisan key:generate
```

This writes `APP_KEY` into `.env`. Required — Laravel uses it for encryption/sessions.

## 5. Front-end assets

Compiled CSS/JS under `public/css` and `public/js` are already tracked in git, so a
fresh pull should already have working assets. You only need Node/npm on the server if
you change front-end source (`resources/js`, `resources/sass`) and need to rebuild:

```bash
npm install
npm run production
```

## 6. Database

Nothing is imported automatically. Two options:

- **Fresh schema**: `php artisan migrate --force`
- **Restore your existing data**: import `DBBackup/demoqc_db.sql` (kept locally,
  not in git) via phpMyAdmin/Plesk's DB import tool, or:
  ```bash
  mysql -u <user> -p <database> < demoqc_db.sql
  ```

## 7. Storage symlink

Laravel serves public file uploads through a symlink that git does not track:

```bash
php artisan storage:link
```

## 8. Permissions

The web server user needs write access to:

```bash
chmod -R 775 storage bootstrap/cache
```

(Adjust ownership/group per Plesk's PHP execution user if `chmod` alone isn't enough.)

## 9. Final checks

- Visit the site — check for a blank page or 500 error first (means `.env`/permissions
  issue)
- Set `APP_DEBUG=false` if you temporarily turned it on to debug — never leave debug
  mode on in production, it leaks stack traces and env values
- Clear/cache config for performance:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```
  Re-run these any time `.env` or routes change, since caching freezes their values.

## Redeploying later

Every subsequent `git pull` via Plesk only updates tracked source files. Re-run steps
3–4 only if `composer.json`/`composer.lock` changed, migrations only if new migration
files were added (`php artisan migrate --force`), and the cache commands in step 9
always, so changes actually take effect.
