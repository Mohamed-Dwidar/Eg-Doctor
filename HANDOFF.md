# EgDoctor — Session Handoff (2026-09-23)

Laravel 12 + `nwidart/laravel-modules` app migrating a legacy CakePHP medical-directory
site ("EgDoctor"). This doc summarizes one long session of work so a fresh session can
pick up without re-deriving context.

## Module structure — three conventions coexist

- **Old style** (Blog, Page, Admin, User, Layout, Seo-partially): code lives directly
  under `Modules/X/Http`, `Modules/X/Services`, etc. — no `app/` wrapper.
- **New style** (Department, Doctor, Question, Article, Information, Degree): everything
  under `Modules/X/app/...`, and the namespace **must** include the literal `app\`
  segment (`Modules\X\app\Http\Controllers\...`) to autoload correctly under this repo's
  root `"Modules\\": "Modules/"` PSR-4 rule.
- **SeoModule**: hybrid — `App/Models`, `App/Http/Controllers` (capital `App`), but
  `Repository/` and `Services/` with no `App` prefix at all.

When adding files, match whichever convention the target module already uses. Several
bugs this session (see below) were exactly this being gotten wrong by earlier
scaffolding.

## What was built this session

**EgDoctor homepage** (`Modules/LayoutModule/resources/views/front/home.blade.php`) —
full Arabic/RTL redesign reusing existing `assets/front` CSS/JS (no new frameworks).
Custom CSS lives in `public/assets/front/css/style_custom.css` (kept out of the Blade
file per explicit instruction). Real logo/favicon wired in. Google Ads placeholders
(4 horizontal + 2 vertical skyscraper rails, wide-screen only). As of the end of the
session, **every dynamic section pulls live DB data**, not hardcoded demo content:
department dropdown + specialty grid, city→zone cascading search (defaults to Cairo,
AJAX with a loading state), 6 random featured doctors, 4 random articles, 4 latest
questions, 6 random medical-info entries.

**Five module CRUDs built/fixed** (Department, Doctor, Question, Article, Information),
each with: full field coverage matching the real migration, the same SEO pattern
(`slug`/`meta_title`/`meta_description`/`meta_tag`/`header_script`/`footer_script` via
the polymorphic `seos` table), an "apply SEO to all" bulk-backfill action, and admin
Bootstrap 5 views. Doctor adds city/zone cascading admin form + department checkboxes.
Question adds an answers-count column + read-only answers modal (answers themselves are
not manageable yet — explicitly deferred). Most of these CRUDs had been pre-scaffolded
(by a prior session/the user) cloned from a working module without adapting field names
— several were fixed from a broken state, not built from scratch. See "Fixed bugs" below.

**SEO infrastructure** (`Modules/SeoModule`):
- `seos` table: polymorphic (`seo_capable_type`/`seo_capable_id`, morph to Department/
  Doctor/Question/Article/Information/Blog) + `slug` (unique) + meta fields. Later
  altered to make `seo_capable_type`/`seo_capable_id` **nullable** and added
  `target_path`, so a row can exist standalone ("manual" entry, not tied to any model).
- `SlugResolverController` (`App/Http/Controllers/SlugResolverController.php`):
  registered via `Route::fallback()` (not a normal route — avoids module-load-order
  shadowing issues). Looks up the decoded request path in `seos.slug`; if it's a
  content-linked row, dispatches to that type's front controller; if it's a manual row,
  **internally forwards** (not redirects) to `target_path` via a sub-request +
  `Router::dispatch()`, and shares the resolved `Seo` row into the container as
  `resolved_seo` so `metas.blade.php` can use the *original* slug's meta data even after
  the forward swaps the bound request.
- Manual SEO admin CRUD at `/admin/seo-manual` (`SeoAdminController`, `Seo::manual()`
  scope = `whereNull('seo_capable_type')`). This replaced an earlier `custom_links`
  table approach that was explicitly rejected by the user mid-session — manual entries
  live in `seos` itself now, not a separate table.
- `SitemapController` / `sitemap.blade.php`: rebuilt to pull from `seos` grouped by
  `seo_capable_type`, raw UTF-8 `<loc>` values (not percent-encoded — deliberate,
  cosmetic choice, both are equally valid).
- `metas.blade.php` (`Modules/LayoutModule/resources/views/front/metas.blade.php`):
  looks up `seos` by current slug (preferring the `resolved_seo` container binding) and
  overrides title/description/keywords/header_script if found, else falls back to the
  original Pivot-template defaults untouched.

**One-off DB migrations from the legacy site** (`dwidar_egdoctor_old`, same MySQL
server): backfilled `slug`/`meta_title`/`meta_description`/`meta_tag` for Department,
Doctor, Question, Article, and Information records by matching `seo_capable_id` against
the numeric ID embedded in the old `links.real_url` (pattern `{type}/view/{id}`).
Every run was dry-run-checked first (dupes, blanks, collisions) and backed up first via
`CREATE TABLE seos_backup_... AS SELECT * FROM seos`. **Backup tables still sitting in
`dwidar_egdoctor`**: `seos_backup_20260917`, `seos_backup_20260918`,
`seos_backup_20260918_doctors`, `seos_backup_20260918_questions`,
`seos_backup_20260918_articles`, `seos_backup_20260918_informations`. Not dropped —
user hasn't confirmed they're done needing them.

## Key decisions

- `Route::fallback()` for slug resolution, not a catch-all route — module route files
  load in `modules_statuses.json` order, so a normal wildcard route would shadow
  everything registered by later-loaded modules.
- Manual SEO entries live in `seos` (nullable morph columns), not a separate table —
  explicit user correction.
- Manual entries **forward** internally rather than redirect, so the visitor's URL bar
  never changes.
- No fabricated ratings/reviews when wiring real doctor data onto the homepage — the
  original mockup had fake star ratings; dropped entirely rather than attach invented
  numbers to real people.
- SEO backfill migrations are always: dry-run → backup → execute → verify. Never skip
  the dry-run step given the DB size (1500+ `seos` rows).

## Fixed bugs (pre-existing, unrelated to what was asked, but blocking it)

- Five front `*ModuleController` classes (Department/Doctor/Question/Article/
  Information) had namespaces missing the `app\` segment — completely unloadable via
  Composer autoload. Fixed by adding `app\` to match their actual file path.
- `main.blade.php` echoed `{{ $page_title }}` / `@if ($breadcrumb)` with no fallback —
  fatal `Undefined variable` on any page not explicitly setting both. Fixed with
  `?? ''` / `?? false`.
- `DepartmentAdminController::store()` chained `->paginate(15)` onto the return of
  `create()` (a single model, not a query builder) — fatal after every successful save.
  Fixed. **`DegreeModule` has the identical bug, still unfixed** — flagged, not touched.
- `InformationModule`'s scaffolded service/controller/views were cloned from
  `ArticleModule` post-fix but never adapted — referenced `doctor_id`/`pic`/`status`/
  `user_id`, none of which exist on `informations` (real columns: `title`, `content`,
  `is_active`). Would have fatal-errored on first save. Rebuilt to match the real schema.
- Several `applySeoToAllX()` methods referenced `$model->name`/`$model->description`
  that don't exist on their models (copy-paste from Department). Fixed to use the
  correct real field per model (`title`, `content`, etc.).
- `SeoRepository::slugCreator()` didn't retry on collision (checked once, appended a
  count, could still collide) and didn't pass `null` as the transliteration language
  (would strip Arabic slugs to empty). Both fixed.

## Known issues — NOT fixed, still open

- **`php artisan` (most commands) is broken**: `Modules/AdminModule/app/Services/
  AdminService.php:21` references an undefined `$permissionRepository` in its
  constructor, and this fires during full app boot — breaks `route:list`, `migrate`
  (module-wide), etc. Worked around all session by running specific migrations with
  `--path=...` and testing via `curl` against the already-running `php artisan serve`
  (port 8000) instead of the CLI. **Someone needs to actually fix `AdminService`.**
- Front-facing `show()`/`index()` methods for Department/Doctor/Question/Article/
  Information are mostly still empty stubs (`return view('xmodule::show')` with no data,
  and the view often doesn't exist). `SlugResolverController` correctly routes to them,
  but visiting a real content slug will often hit "view not found". Building the actual
  public detail-page templates (parallel to what exists for the homepage) is unstarted,
  substantial work.
- `question_answers` table uses legacy `created`/`modified` columns, not Laravel's
  `created_at`/`updated_at`. Harmless for reads (all current answer access is read-only)
  but `QuestionAnswer::save()`/`create()` will fatal the moment anyone builds real
  answer-management CRUD, since Eloquent will try to write timestamp columns that don't
  exist.
- `doctrine/dbal` is not installed, so any future migration needing `Schema::table(...)
  ->change()` needs a raw `DB::statement('ALTER TABLE ... MODIFY ...')` instead (see
  `Modules/SeoModule/Database/migrations/2026_09_20_233307_...` for the pattern used).
- `footer_script` (a real `seos` column) is not wired into any layout — `metas.blade.php`
  only controls `<head>`, and nothing currently renders a `footer_script` slot near
  `</body>`. `header_script` is wired.
- Six `seos_backup_*` tables left in the DB (see above) — cleanup pending user sign-off.

## Local dev environment

- MySQL client is **not on PATH** — use
  `/usr/local/mysql-9.4.0-macos15-x86_64/bin/mysql --default-character-set=utf8mb4
  -h127.0.0.1 -P3306 -uroot -p123@Pass`. Always pass `--default-character-set=utf8mb4`
  or Arabic text prints as `?`.
- Two DBs on the same server: `dwidar_egdoctor` (current app, `.env`) and
  `dwidar_egdoctor_old` (legacy CakePHP data — read-only source for the SEO backfills).
  Cross-database `JOIN`s work directly since they're on the same server.
- A dev server is already running (`php artisan serve`, port 8000, confirmed via
  `lsof -iTCP -sTCP:LISTEN`) — use `curl` against `http://127.0.0.1:8000/` to verify
  changes live, since full `artisan` CLI is broken (see above).
- When writing multi-line SQL with backslash-escaped `seo_capable_type` string literals
  (e.g. `'Modules\\DoctorModule\\app\\Models\\Doctor'`), write it to a `.sql` file via a
  `<<'SQL'` heredoc (quoted delimiter = no shell interpolation) and run
  `mysql < file.sql` — passing it inline through `-e "..."` mangles the backslash count
  via bash's own quoting and silently matches zero rows.

## Important files

| Area | File |
|---|---|
| Homepage | `Modules/LayoutModule/resources/views/front/home.blade.php` |
| Homepage controller | `Modules/LayoutModule/app/Http/Controllers/LayoutModuleController.php` |
| Homepage custom CSS | `public/assets/front/css/style_custom.css` |
| Shared front `<head>` | `Modules/LayoutModule/resources/views/front/metas.blade.php` |
| Shared front layout | `Modules/LayoutModule/resources/views/front/main.blade.php` |
| Slug routing | `Modules/SeoModule/App/Http/Controllers/SlugResolverController.php` |
| Slug routing entry | `Modules/SeoModule/routes/web.php` (`Route::fallback`) |
| Seo model | `Modules/SeoModule/App/Models/Seo.php` |
| Manual SEO CRUD | `Modules/SeoModule/App/Http/Controllers/Admin/SeoAdminController.php` |
| Sitemap | `Modules/SeoModule/App/Http/Controllers/SitemapController.php` + `resources/views/sitemap.blade.php` |
| Doctor CRUD + city/zone AJAX | `Modules/DoctorModule/app/Http/Controllers/Admin/DoctorAdminController.php` |
| Admin sidebar nav | `Modules/LayoutModule/resources/views/admin/sidebar.blade.php` |
| Lang strings | `lang/en/messages.php`, `lang/ar/messages.php` |
| Broken pre-existing file | `Modules/AdminModule/app/Services/AdminService.php` (line 21) |

## Suggested next steps

1. Fix `AdminService.php` so `php artisan` works again (route:list, migrate, etc.) — this
   unblocks a lot of would-be-faster verification.
2. Build real public detail-page templates for Department/Doctor/Question/Article/
   Information `show()` (biggest remaining chunk of work; homepage is done, detail pages
   aren't).
3. Decide what to do with the `seos_backup_*` tables (drop or keep).
4. Fix the `DegreeModule::store()` `->paginate(15)` bug (same class of bug already fixed
   elsewhere, never touched in Degree).
5. If real answer-management CRUD is wanted for QuestionModule, fix the
   `question_answers` timestamp column mismatch first.
