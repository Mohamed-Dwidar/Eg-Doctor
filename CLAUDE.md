# Project: EgDoctor (?)

@docs/progress.md

Arabic medical-directory site (doctors by specialty/city/zone, articles, Q&A, medical info, videos), migrated from a legacy CakePHP site to Laravel 12 + `nwidart/laravel-modules`.

## Before you start (every session)
1. `docs/progress.md` is loaded above — treat it as the latest state, decisions, and cross-module dependencies.
2. Run `git log --oneline -15` to see recent changes.
3. If the task touches a module listed under "Dependencies map", check the related files before editing.

## When a task or feature is done
When a task is finished, or when I say "update progress" or run /checkpoint, update `docs/progress.md`:
- Edit the relevant module section (files, how it works, dependencies, decisions, pending) — don't just append.
- Add one entry to the session log; keep only the last 10 entries.
- Update "Current status".
Then suggest a commit message.

## Stack
- Framework: Laravel 12 / PHP ^8.2, modular via `nwidart/laravel-modules` ^12 (enabled list: `modules_statuses.json`)
- Database: MySQL (`DB_*` in `.env`); current DB plus a legacy DB on the same server used as read-only migration source (?)
- Frontend: Blade + static assets in `public/assets/{front,admin}` (jQuery/Bootstrap-era theme). Vite + Tailwind 4 are in `package.json` but **not used** by any view (no `@vite`)
- Admin UI: Bootstrap theme under `public/assets/admin`
- Auth: custom `admin` guard (`config/auth.php`, provider `admins`) → middleware `auth:admin`; no Breeze/Jetstream
- Permissions: none (no roles/permissions package)
- Key packages: `prettus/l5-repository` (repositories), `yajra/laravel-datatables-oracle`, `maatwebsite/excel`, `barryvdh/laravel-dompdf`, `intervention/image` ^2.7. `doctrine/dbal` NOT installed → use raw `DB::statement('ALTER TABLE …')` for column changes
- Third-party front scripts: Google Tag Manager (`front/metas.blade.php`, `front/main.blade.php`), Google AdSense (`front/main.blade.php`, `front/footer.blade.php`, `public/ads.txt`)

## Commands
- Dev server: `php artisan serve` (or `composer dev` — also starts queue, pail, vite)
- Assets: none needed (static files in `public/assets`)
- Migrate: `php artisan migrate` / per module `php artisan migrate --path=Modules/XModule/Database/migrations`
- Tests: `php artisan test` (only Laravel example tests exist)
- Clear caches: `php artisan optimize:clear`
- Format: `vendor/bin/pint` (?) — not clear it has been run on the codebase
- Routes: `php artisan route:list --except-vendor`
- Verify front changes live: `curl http://127.0.0.1:8000/...` (dev server usually already running on port 8000 — check `lsof -iTCP -sTCP:LISTEN`)

## Local dev / database
- MySQL client is not on PATH: `/usr/local/mysql-9.4.0-macos15-x86_64/bin/mysql --default-character-set=utf8mb4 -h127.0.0.1 -P3306 -uroot -p` (credentials from `DB_USERNAME`/`DB_PASSWORD`). Always pass `--default-character-set=utf8mb4` or Arabic prints as `?`.
- Two DBs on the same server: current app DB (`DB_DATABASE`) and the legacy CakePHP DB (`DB_DATABASE` + `_old` suffix) — read-only source for backfills; cross-database `JOIN`s work directly.
- SQL containing backslashed morph types (`'Modules\\DoctorModule\\app\\Models\\Doctor'`): write it to a `.sql` file via a `<<'SQL'` heredoc and run `mysql < file.sql` — inline `-e "..."` mangles the backslashes and silently matches zero rows.
- Column changes without `doctrine/dbal`: follow `Modules/SeoModule/Database/migrations/2026_09_20_233307_add_manual_entry_support_to_seos_table.php` (raw `ALTER TABLE … MODIFY`).

## Project structure
- `Modules/` — all features, one nwidart module each (see Dependencies map)
- `Modules/LayoutModule/resources/views/front/` — public layout (`main`, `metas`, `header`, `footer`, `home`)
- `Modules/LayoutModule/resources/views/admin/` — admin layout + `sidebar.blade.php`
- `app/Helpers/` — shared traits/helpers (`UploaderHelper` → uploads to `public/uploads/{folder}`, `GeneralHelper`, `ApiResponseHelper`, `FcmHelper`)
- `app/Rules/SafeText.php` — validation rule for public user input
- `public/assets/front/css/style_custom.css` — custom front CSS (keep CSS out of Blade files)
- `lang/{ar,en}/messages.php` — UI strings
- `routes/web.php` — empty; all routes live in `Modules/*/routes/web.php`

## Conventions
- **Module layout — three styles coexist, match the target module:**
  - New (`app/` wrapper, lowercase): Admin, User, Page, Layout, Department, Degree, Doctor, Question, Article, Information, Video → namespace `Modules\XModule\app\...` (literal `app\` segment required by root PSR-4 `Modules\\` → `Modules/`)
  - Old (no wrapper, capitalized dirs): Blog → `Modules\BlogModule\Http\...`, `Entities/`, `Repository/`, `Resources/views`
  - Hybrid: Seo → `Modules\SeoModule\App\...` (capital `App`) but `Repository/` and `Services/` at module root
- Layers: Controller → Service → Repository (prettus `BaseRepository`) → Model. Front controller `XModuleController`, admin controller `Admin/XAdminController`
- Models: `scopeFilter($query, $request)` for admin list filters; content models `morphOne(Seo::class, 'seo_capable')`
- Route names: admin `admin.{plural}` (index), `admin.{plural}.{add|store|view|edit|update|delete|apply-seo}`; front `{plural}` / `{plural}.{action}`. Admin URLs: `admin/{plural}/add`, `/edit/{id}`, `POST /update` (id in body), `POST /delete/{id}`
- Always use named routes — never hardcoded URLs (some layout/footer/sitemap views still contain `href="/..."` — inconsistent)
- Public content detail URLs are **SEO slugs** resolved by `SlugResolverController` (no per-module `show` routes)
- Validation: inline `Validator::make()` in controllers (`validationRules()`/`validationMessages()` helpers); FormRequests only in older Blog/User/Admin login. Public input uses `SafeText`
- Language / direction: front is Arabic RTL (`<html lang="ar" dir="rtl">`); admin is English LTR; front flash/validation messages hard-coded in Arabic, admin flash messages in English
- Naming: DB tables plural snake_case; some legacy columns kept (`question_answers.created/modified`, mapped via `CREATED_AT`/`UPDATED_AT` constants); views `xmodule::admin.*`, `xmodule::guest.*` (Doctor uses root-level `show`/`search` views — inconsistent)
- DB data fixes: dry-run (dupes, blanks, collisions) → `CREATE TABLE seos_backup_… AS SELECT` → execute → verify. Never skip the dry run (1500+ `seos` rows)
- Several modules were scaffolded by cloning another module — always check field names against the module's migration (past bugs: wrong columns, `$model->name` on models without it, `->paginate()` after `create()`)

## Dependencies map (what affects what)
- **SeoModule** ↔ every content model (polymorphic `seos` table: Department, Doctor, Question, Article, Information, Blog, Video). `SlugResolverController::$map` dispatches slugs to each module's front `show()`; `SeoRepository::slugCreator()` used by every content Service; `metas.blade.php` (Layout) reads `seos`; `SitemapController` groups by `seo_capable_type`. Renaming a model class breaks stored `seo_capable_type` values
- **LayoutModule** ↔ all front views (`front.main`), admin views (`admin.main`, `sidebar` — add new admin modules there); homepage controller pulls from Department, Doctor, Article, Question, Information
- **DoctorModule** ↔ Department (`doctor_departments` pivot), Degree (`degree_id`), City/Zone (own models; `zones-by-city` AJAX used by homepage search), Article (`articles.doctor_id`)
- **QuestionModule** ↔ `question_answers` (public answer form + admin read-only modal)
- **AdminModule** ↔ `admin` guard used by every `admin/*` route group
- **Blog / Page / User modules** — older modules from the base template (?); Blog is still in the SEO map
- **(planned)** — none listed yet; add here with expected connections (new content types will need a `seo()` morph + `SlugResolverController::$map` entry + sidebar link)

## Rules
- Before renaming anything shared (routes, components, config keys), search the whole project for references and update them all.
- Never edit migrations that already ran — create a new migration.
- Ask before deleting files or changing shared layouts.
- Keep changes minimal and scoped to the task.
