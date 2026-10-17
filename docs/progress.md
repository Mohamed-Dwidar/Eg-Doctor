# Project Progress

> Loaded into every session via CLAUDE.md — keep it short and current.
> Edit module sections in place. Session log: last 10 entries only (git has the rest).
> Cross-module links: see "Dependencies map" in CLAUDE.md.

---

## Current status
- **Working on:** uncommitted — new `CLAUDE.md` + `docs/progress.md` (project memory; "(?)" items await user confirmation); `HANDOFF.md` deleted (content merged into these two files); `config/app.php` timezone `Asia/Dubai` → `Africa/Cairo` (+ whitespace); deletion of `eg_doctor_old_25-09-2026.zip` (23 MB legacy archive, was tracked). Branch `main`, in sync with `origin/main`.
- **Recent (2026-09-24 → 09-28):** VideoModule, public list/detail pages for Department/Doctor/Article/Question/Information/Video, info section, Google AdSense + `ads.txt` + `robots.txt`, Google Tag Manager, mobile search/CSS fixes, article image.
- **Next up:** (?) not stated — candidates: fix Degree `store()` bug, wire `footer_script`, decide on `seos_backup_*` tables, lock down `pages/{slug}/edit`.
- **Known issues:**
  - `DegreeAdminController::store()` chains `->paginate(15)` on a created model (line 58) → fatal after save.
  - `seos.footer_script` is not rendered by any layout (`header_script` is).
  - AdSense units use real client/slot IDs, but comments still say "swap this placeholder" — stale comments.
  - Public `POST questions/{id}/answer` has no throttle and no moderation (?) — answers go live immediately.
  - Six backup tables in the app DB, pending decision to drop (?) — not re-checked: `seos_backup_20260917`, `seos_backup_20260918`, `seos_backup_20260918_{doctors,questions,articles,informations}`.
  - Admin `main.blade.php` contains a second `<html>` document block (line ~192) with broken CDN `') }}"` URLs — leftover template (?).
  - Only example tests; no real test coverage.

---

## Modules

### LayoutModule
- **Last updated:** 2026-09-28
- **Files:** `app/Http/Controllers/LayoutModuleController.php`, `resources/views/front/{main,metas,header,footer,home}.blade.php`, `front/home_sections/*`, `admin/{main,sidebar,header,footer}.blade.php`, `public/assets/front/css/style_custom.css`
- **How it works:** `home_page` (`/`) loads departments, city→zone search (default Cairo), 6 random doctors, 4 random articles, 4 latest questions, 6 random informations. `metas.blade.php` overrides title/description/keywords/header_script from `seos` (prefers `resolved_seo` container binding). GTM + AdSense in head/body; vertical ad rails on wide screens.
- **Decisions:**
  - No fake ratings/reviews on real doctors — dropped from mockup.
  - Custom CSS in `style_custom.css`, not inline in Blade.
- **Pending:** `footer_script` slot near `</body>`; `welcome.blade.php` has a TODO (price-list link) — page may be unused (?).

### SeoModule
- **Last updated:** 2026-09-26
- **Files:** `App/Http/Controllers/SlugResolverController.php`, `App/Http/Controllers/Admin/SeoAdminController.php`, `App/Http/Controllers/SitemapController.php`, `App/Models/Seo.php`, `Repository/SeoRepository.php`, `Services/SeoService.php`, `routes/web.php`, migrations `2024_02_21_…create_seos_table`, `2026_09_20_…add_manual_entry_support`
- **How it works:** polymorphic `seos` (slug unique + meta fields + header/footer scripts). `Route::fallback()` → `SlugResolverController` looks up decoded path in `seos.slug`; content rows dispatch to the module's `show()`; manual rows (null morph, `target_path`) are internally forwarded (URL unchanged). Manual CRUD at `/admin/seo-manual`. `/sitemap.xml` from `seos`.
- **Decisions:**
  - `Route::fallback()` instead of wildcard route — module route load order would shadow later modules.
  - Manual entries live in `seos` (nullable morph), not a separate table — user rejected an earlier `custom_links` table approach.
  - Manual entries forward internally, not redirect — visitor's URL bar never changes; `resolved_seo` binding keeps the original slug's metas.
  - Sitemap `<loc>` uses raw UTF-8 Arabic, not percent-encoded (cosmetic; both valid).
  - `slugCreator()` retries on collision and passes `null` transliteration language so Arabic slugs aren't stripped.
  - Legacy backfill (2026-09-17/18): slug + meta fields for Department/Doctor/Question/Article/Information copied from legacy `links.real_url` (pattern `{type}/view/{id}` → `seo_capable_id`), each run dry-run + backed up.
- **Pending:** resource route `seomodule/*` (scaffold, public, no auth) (?) — probably unused, consider removing.

### DepartmentModule
- **Last updated:** 2026-09-24
- **Files:** `app/Http/Controllers/{DepartmentModuleController,Admin/DepartmentAdminController}.php`, `app/Models/Department.php`, `app/Services/DepartmentService.php`, `resources/views/{admin,guest}/*`
- **How it works:** admin CRUD + "apply SEO to all"; public `/departments` list and slug detail page (`guest.show`).
- **Pending:** none known.

### DoctorModule
- **Last updated:** 2026-09-26
- **Files:** `app/Http/Controllers/{DoctorModuleController,Admin/DoctorAdminController}.php`, `app/Models/{Doctor,City,Zone,DoctorDepartment}.php`, 4 repositories, `app/Services/DoctorService.php`, views `admin/*`, `show`, `search`, `search-form`
- **How it works:** admin CRUD with city/zone cascade + department checkboxes + apply-SEO. Public search form at `/بحث-عن-طبيب`, results `/doctors/search`, detail via slug. `zones-by-city/{city}` is public (handled by the admin controller).
- **Pending:** `index()` returns stub `doctormodule::index`; no public doctor list route (?).

### DegreeModule
- **Last updated:** 2026-09-04 (?)
- **Files:** `app/Http/Controllers/Admin/DegreeAdminController.php`, `app/Models/Degree.php`, `app/Services/DegreeService.php`, `resources/views/admin/*`
- **How it works:** admin CRUD only for doctor degrees (`doctors.degree_id`). No SEO, no public pages.
- **Pending:** `store()` `->paginate(15)` bug; not linked in admin sidebar (?).

### QuestionModule
- **Last updated:** 2026-09-24
- **Files:** `app/Http/Controllers/{QuestionModuleController,Admin/QuestionAdminController}.php`, `app/Models/{Question,QuestionAnswer}.php`, 2 repositories, `app/Services/QuestionService.php`, `resources/views/{admin,guest}/*`
- **How it works:** admin CRUD + answers-count + read-only answers modal. Public `/questions` list, slug detail, `POST questions/{id}/answer` (AJAX or form, `SafeText` validation, Arabic messages). `QuestionAnswer` maps timestamps to legacy `created`/`modified`.
- **Pending:** admin answer management (edit/delete/approve); spam protection on public answers (?).

### ArticleModule
- **Last updated:** 2026-09-28
- **Files:** `app/Http/Controllers/{ArticleModuleController,Admin/ArticleAdminController}.php`, `app/Models/Article.php`, `app/Services/ArticleService.php`, `resources/views/{admin,guest}/*`
- **How it works:** admin CRUD (pic upload via `UploaderHelper`, optional `doctor_id`, `status`) + apply-SEO; public `/articles` paginated list + slug detail.
- **Pending:** none known.

### InformationModule
- **Last updated:** 2026-09-25
- **Files:** `app/Http/Controllers/{InformationModuleController,Admin/InformationAdminController}.php`, `app/Models/Information.php`, `app/Services/InformationService.php`, `resources/views/{admin,guest}/*`
- **How it works:** medical-info entries (`title`, `content`, `is_active`); admin CRUD + apply-SEO; public `/informations` + slug detail.
- **Pending:** none known.

### VideoModule
- **Last updated:** 2026-09-24
- **Files:** `app/Http/Controllers/{VideoModuleController,Admin/VideoAdminController}.php`, `app/Models/Video.php`, `app/Services/VideoService.php`, migration `2026_09_24_…create_videos_table`, `resources/views/{admin,guest}/*`
- **How it works:** admin CRUD + apply-SEO; public `/videos` + slug detail (sidebar: read-also, latest questions, random informations).
- **Pending:** none known.

### AdminModule
- **Files:** `app/Http/Controllers/Auth/AdminAuthController.php`, `app/Http/Controllers/Admin/AdminController.php`, `app/Models/Admin.php`, `app/Services/AdminService.php`
- **How it works:** `/admin` login (`LoginAdminRequest`), `admin` guard, admin users CRUD (?) — no admin-users routes appear in `route:list`.
- **Decisions:** the `$permissionRepository` boot crash (undefined `$permissionRepository` at `AdminService.php:21`) is gone — `php artisan` boots again (verified 2026-10-17).
- **Pending:** unused `$permissionRepository` property; no roles/permissions.

### BlogModule / PageModule / UserModule
- **Files:** `Modules/BlogModule/*` (old style), `Modules/PageModule/app/*`, `Modules/UserModule/app/*`
- **How it works:** carried over from the base template (?). Blog: admin CRUD + `/blogs`, `/blogs/singleBlog/{id}`, in SEO map. Page: admin CRUD with sub-pages + `/pages/{slug}`. User: front user login views + API stubs.
- **Pending:** decide whether Blog/User are needed (?); public `pages/{slug}/edit` route sits outside the `auth:admin` group (verified) — check what `editPage` exposes.

---

## Session log

### 2026-10-17 — Initial project memory setup
- **Changed:** `CLAUDE.md`, `docs/progress.md` filled from codebase + `HANDOFF.md` (its still-relevant content merged in — local DB tips, SEO decisions, backup table names — then `HANDOFF.md` deleted) (verified against current code: artisan boots, `route:list` checked, QuestionAnswer timestamps fixed, detail pages built; Degree `store()` bug, missing `footer_script`, unauthenticated `pages/{slug}/edit` still open).
- **Why:** persistent project memory across sessions. User left the project-description template unfilled, so everything was inferred from code; "(?)" items still need user confirmation.
- **Affects:** docs only — no code changed.
- **Commit:** not committed yet.
