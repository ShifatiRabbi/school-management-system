# Security Report — School Management System

**Date:** 2026-07-16  
**Scope:** Full codebase audit, malware scan, hardening, and residual review

## Executive summary

The project had no classic webshells or obfuscated malware, but carried high-risk issues: hardcoded DB credentials, systemic reflected XSS, no CSRF protection, GET-based deletes, weak upload validation, insecure sessions, and unprotected include directories. These have been mitigated with a central security core, hardened endpoints, directory protections, and safer defaults.

**Action required in production:** rotate the database password immediately and load credentials from environment variables.

---

## Vulnerabilities found

### Critical

| ID | Finding | Status |
|----|---------|--------|
| C1 | Hardcoded DB credentials in `DB_connection.php` / duplicate `config.php` | Mitigated — credentials moved to `app/config/config.php` with env overrides; duplicate removed; file access denied in `.htaccess`. **Rotate password.** |
| C2 | Reflected XSS via unescaped `$_GET['error']` / `success` and sticky fields | Mitigated — `e()` helper + escaped flashes across views |
| C3 | No CSRF on state-changing requests | Mitigated — CSRF tokens on forms; validation on admin `req/*`, deletes, contact, login |
| C4 | Unrestricted / weak file uploads (possible RCE) | Mitigated — `Upload` helper + gallery MIME checks; SVG removed; uploads `.htaccess` disables PHP |
| C5 | Empty decoy `wp-admin.php` | Removed |

### High

| ID | Finding | Status |
|----|---------|--------|
| H1 | GET-based delete endpoints (CSRF via link) | Mitigated — POST + CSRF; UI links converted to forms |
| H2 | `admin/req/get-sections.php` unauthenticated | Mitigated — Admin auth required; output escaped |
| H3 | `admin/ajax/*` missing strong role/CSRF checks | Partially mitigated — role checks + CSRF on destructive AJAX |
| H4 | Insecure session handling (no regenerate / cookie flags / timeout) | Mitigated — `Session` + `Auth::loginUser` |
| H5 | Teacher could update salary/bank/subjects/classes | Mitigated — Teacher update path no longer writes those fields |
| H6 | Missing Teacher/Student `index.php` post-login targets | Mitigated — landing pages added; login redirects fixed |
| H7 | `data/` and `inc/` web-accessible | Mitigated — `Require all denied` `.htaccess` files |

### Medium

| ID | Finding | Status |
|----|---------|--------|
| M1 | `mkdir(..., 0777)` | Reduced — secure upload paths use `0755` |
| M2 | Gallery allowed SVG (stored XSS) | Mitigated — SVG removed from allowlist |
| M3 | `LIMIT $limit` interpolation in news helper | Mitigated — cast to `(int)` |
| M4 | No login rate limiting | Mitigated — attempt counter + lockout |
| M5 | Sensitive errors potentially displayed | Mitigated — production display_errors off; log to `storage/logs` |
| M6 | Public deletes on `class-view.php` | Removed |

### Low

| ID | Finding | Status |
|----|---------|--------|
| L1 | Duplicate data helpers across roles | Deferred — structure prepared under `app/models` |
| L2 | Bot UA blocking could break monitoring | Relaxed in updated `.htaccess` |
| L3 | Optional PhpSpreadsheet vendor missing | Documented — install when Excel import needed |

---

## Malware removed

| Item | Notes |
|------|-------|
| `wp-admin.php` | Empty decoy / scanner bait — deleted |
| `error_log` | Contained runtime noise; removed from web root |
| `cgi-bin/`, `details-file/` | Empty unused directories — removed |

**Scan results:** No `eval`, `base64_decode` webshells, `shell_exec`, `system`, `passthru`, or encoded PHP backdoors found in application source.

---

## Files modified (high level)

### New core

- `app/bootstrap.php`
- `app/config/config.php`, `config.example.php`
- `app/core/{Database,Session,Auth,Csrf,Security}.php`
- `app/helpers/{functions,Validator,Upload}.php`
- `app/middleware/admin_guard.php`
- `.htaccess` (hardened)
- `uploads/.htaccess`, `app/.htaccess`, `storage/.htaccess`, `database/.htaccess`, `*/data/.htaccess`, `*/inc/.htaccess`

### Authentication / public

- `DB_connection.php` (shim)
- `req/login.php`, `req/contact.php`
- `login.php`, `logout.php`
- `header.php`, `contact.php`, `all-subject.php`, `index.php` (cleanup)

### Admin / roles

- Delete handlers converted to POST+CSRF
- `admin/req/*` CSRF + Auth guards
- `admin/ajax/delete-*.php`, `get-sections.php`
- `admin/data/gallery.php`, `admin/data/news.php`
- `admin/req/teacher-add.php` secure upload
- `Teacher/req/teacher-edit.php` privilege + upload hardening
- `Teacher/index.php`, `Student/index.php`
- List/search pages: delete links → POST forms; XSS flash escaping

### Removed

- `config.php` (duplicate secrets)
- `wp-admin.php`
- Root `error_log`
- Empty `cgi-bin/`, `details-file/`

---

## Security improvements implemented

1. Central bootstrap for every request path that includes DB/session
2. Secure session cookie parameters + regeneration + idle timeout
3. Role middleware helpers (`Auth::requireAdmin` etc.)
4. CSRF token generation/validation helpers (`csrf_field()`, header meta)
5. XSS escaping helper `e()` / `alert_from_query()`
6. Secure upload validation pipeline
7. Directory hardening and upload PHP execution prevention
8. Security response headers including CSP
9. Login brute-force rate limiting
10. Teacher privilege restriction on sensitive fields
11. Prepared-statement usage retained/strengthened (LIMIT casts)
12. Documentation of residual risks and required credential rotation

---

## Residual risks / recommendations

1. **Rotate DB password** and remove fallback password from `app/config/config.php` once env vars are set.
2. Install Composer PhpSpreadsheet only if Excel import is required; keep `vendor/` patched.
3. Continue consolidating duplicated `data/` libraries into `app/models` to avoid drift.
4. Consider moving to a true `public/` document root on VPS hosts.
5. Add CAPTCHA on public contact/login if abuse appears.
6. Periodically re-scan uploads for unexpected file types.

---

## Post-hardening verification checklist

- [x] Malware/decoy files removed
- [x] Sensitive directories denied
- [x] Login CSRF + rate limit + session regenerate
- [x] Deletes require POST + CSRF
- [x] Upload MIME/extension hardening (gallery + teacher flows)
- [x] XSS flash messages escaped
- [x] Unauthenticated get-sections fixed
- [ ] Production credential rotation (operator action)
- [ ] Full interactive UI QA on staging with live DB
