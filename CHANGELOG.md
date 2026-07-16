# Changelog

All notable changes from the security hardening and restructuring effort.

## [2.0.0] — 2026-07-16

### Security

- Introduced `app/` security core: bootstrap, config, Auth, Session, Csrf, Security headers, Upload helper, validators
- Hardened login (`req/login.php`): CSRF, rate limiting, session regeneration, safer redirects
- Secured logout session destruction
- Added CSRF tokens to POST forms and admin request handlers
- Converted destructive GET deletes to POST + CSRF forms
- Escaped reflected flash/query output with `e()` / `alert_from_query()`
- Hardened gallery and teacher image uploads (MIME, extension, random names; SVG disallowed)
- Restricted teacher self-edit so salary/bank/subjects/classes cannot be changed by teachers
- Protected `app/`, `data/`, `*/data/`, `*/inc/`, `storage/`, `database/`, and uploads against direct abuse
- Updated root `.htaccess` with CSP and stronger file protections
- Removed decoy `wp-admin.php`, duplicate secret-bearing `config.php`, and web-root `error_log`

### Structure

- Added professional layout: `app/`, `assets/`, `storage/`, `database/`, `docs/`
- Moved SQL dump to `database/spahhse1_sms.sql`
- Kept legacy public/role URLs for shared-hosting compatibility
- `DB_connection.php` now boots the secure application core

### Fixes

- Added missing `Teacher/index.php` and `Student/index.php` landing pages
- Fixed post-login redirects for Teacher and Student roles
- Removed public delete controls incorrectly exposed on `class-view.php`
- Cast news `LIMIT` clauses to integers
- Restored/cleaned pages damaged during automated XSS remediation

### Documentation

- Replaced README with full developer/operator guide
- Added `SECURITY_REPORT.md`
- Added this `CHANGELOG.md`
- Added `.gitignore` and `app/config/config.example.php`

### Performance / cleanup

- Removed empty unused directories (`cgi-bin`, `details-file`)
- Centralized includes through bootstrap (single session/DB initialization path)
- Disabled display_errors in production; log to `storage/logs`

### Notes

- Excel result import still requires optional `phpoffice/phpspreadsheet` in `vendor/`
- Operators must rotate database credentials and prefer environment variables in production
