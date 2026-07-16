# School Management System (SMS)

Production-oriented PHP/MySQL school portal with a public website and role-based dashboards for Admin, Teacher, Student, and Registrar Office.

## Project overview

This application powers a school’s public presence (notices, news, gallery, routines, results) and internal management (teachers, students, classes, sections, subjects, results, events, governing body, and registrar users).

The codebase has been reorganized around a shared application core (`app/`) while keeping existing public and role URLs working on typical shared hosting (document root = project root).

## Features

- Public school website (home, about, labs, gallery, news, notices, routines, contact)
- Public JSC/SSC result lookup pages
- Role-based login (Admin, Teacher, Student, Registrar Office)
- Admin: teachers/staff, students, classes, sections, subjects, results, notices, news, events, gallery, routines, settings, messages, governing body, registrar users
- Teacher: classes, students, profile/password management
- Student: grade summary, password change
- Registrar Office: student registration and listing
- Secure file uploads for images/documents
- CSRF protection, XSS escaping helpers, secure sessions, security headers

## Folder structure

```text
/
├── app/                      # Application core (not web-executable)
│   ├── bootstrap.php         # Session, DB, helpers, security headers
│   ├── config/               # Configuration (env-aware)
│   ├── core/                 # Database, Session, Auth, Csrf, Security
│   ├── helpers/              # e(), validators, secure Upload
│   ├── middleware/           # Shared guards
│   ├── models/               # Reserved for shared data models
│   └── services/             # Reserved for domain services
├── assets/                   # Canonical static assets (css/js/images)
├── css/, img/, logo.png      # Legacy asset paths (kept for URL compatibility)
├── admin/                    # Admin UI + data/req/ajax handlers
├── Teacher/                  # Teacher UI
├── Student/                  # Student UI
├── RegistrarOffice/          # Registrar UI
├── uploads/                  # User uploads (PHP execution disabled)
├── storage/logs/             # Application error logs
├── database/                 # SQL dump(s)
├── docs/                     # Extra documentation
├── req/                      # Public request handlers (login, contact)
├── data/                     # Shared public data helpers
├── DB_connection.php         # BC shim → app/bootstrap.php
├── index.php, login.php …    # Public pages
├── SECURITY_REPORT.md
├── CHANGELOG.md
└── README.md
```

## System architecture

```text
Browser
  → Public pages (index, notices, …) / Role dashboards
      → app/bootstrap.php
          → Config + secure session
          → PDO connection
          → Helpers (e, csrf, validation, upload)
      → Role checks (Auth)
      → Data helpers (admin/data/*, …)
      → MySQL
```

- **Entry points:** PHP pages in `/`, `/admin`, `/Teacher`, `/Student`, `/RegistrarOffice`
- **Shared bootstrap:** `DB_connection.php` or `app/bootstrap.php`
- **Persistence:** MySQL via PDO prepared statements
- **Front-end:** Bootstrap 5 + project CSS; jQuery on admin pages; CDN assets

## User roles

| Role | Session keys | Landing page |
|------|--------------|--------------|
| Admin | `admin_id`, `role=Admin` | `admin/index.php` |
| Teacher | `teacher_id`, `role=Teacher` | `Teacher/classes.php` |
| Student | `student_id`, `role=Student` | `Student/grade.php` |
| Registrar Office | `r_user_id`, `role=Registrar Office` | `RegistrarOffice/index.php` |

## Admin functionality

- Manage teachers and staff (CRUD, import/export CSV)
- Manage students, classes, sections, subjects/courses
- Manage academic results (manual + Excel import when PhpSpreadsheet is installed)
- Manage notices, news, events, gallery, routines
- Governing body members
- Registrar office users
- School settings
- Contact message inbox

## Teacher functionality

- View assigned classes and students
- Edit own profile (non-sensitive fields only; salary/bank/subjects/classes are admin-controlled)
- Change password

## Student functionality

- View grade/score summary
- Change password

## Registrar Office functionality

- Register students
- List/search students

## Authentication flow

1. User submits `login.php` with username, password, role + CSRF token
2. `req/login.php` validates CSRF, applies rate limiting, looks up user with prepared statement
3. Password verified with `password_verify()`
4. Session ID regenerated; role-specific ID stored
5. Redirect to role dashboard
6. Inactivity timeout enforced (default 2 hours)
7. `logout.php` destroys session completely

## Database overview

SQL dump: `database/spahhse1_sms.sql`

Primary tables (representative):

- `admin`, `teachers`, `students`, `registrar_office`
- `class`, `section`, `subjects`
- `results`, `previous_results`
- `notices`, `news`, `events`, `gallery_images`
- `routines`, `message`, `setting`, governing body tables

Passwords are stored as `password_hash()` digests.

## Installation steps

1. Upload project files to the web root (or point the vhost document root here).
2. Create a MySQL database and import `database/spahhse1_sms.sql`.
3. Configure credentials via environment variables (recommended) or `app/config/config.php`.
4. Ensure `uploads/` and `storage/logs/` are writable by the web user (`0755` dirs, `0644` files).
5. Confirm Apache `mod_rewrite` and `mod_headers` are enabled.
6. Open `/login.php` and sign in with an admin account from the imported data (change the password immediately).

## Configuration

Environment variables (preferred):

| Variable | Purpose |
|----------|---------|
| `SMS_APP_NAME` | Application name |
| `SMS_APP_ENV` | `production` / `development` |
| `SMS_APP_DEBUG` | `0` or `1` (never enable in production) |
| `SMS_APP_URL` | Full base URL (e.g. `https://school.example`) |
| `SMS_TIMEZONE` | Default `Asia/Dhaka` |
| `SMS_DB_HOST` | Database host |
| `SMS_DB_NAME` | Database name |
| `SMS_DB_USER` | Database user |
| `SMS_DB_PASS` | Database password |

See `app/config/config.example.php`.

**Important:** Rotate the database password after deployment. Do not commit production secrets.

## Environment setup

- PHP 8.1+ (cPanel ea-php81 compatible)
- MySQL 5.7+ / MariaDB 10.3+
- Apache with `AllowOverride` for `.htaccess`
- PHP extensions: `pdo_mysql`, `fileinfo`, `mbstring`, `gd` (recommended), `openssl`

Optional for Excel result import:

```bash
composer require phpoffice/phpspreadsheet
```

Place `vendor/` in the project root so `admin/ajax/import-results.php` can autoload it.

## Security features

- Central bootstrap with secure session cookies (`HttpOnly`, `SameSite`, strict mode)
- Session regeneration on login + inactivity timeout
- CSRF tokens on POST forms and destructive actions
- Output escaping helper `e()`
- PDO prepared statements
- Password hashing with `password_hash` / `password_verify`
- Secure upload helper (extension + MIME + image validation + random names)
- Upload directory blocks PHP execution
- Sensitive dirs (`app/`, `*/data/`, `storage/`, `database/`) denied via `.htaccess`
- Security headers: CSP, X-Frame-Options, X-Content-Type-Options, Referrer-Policy, Permissions-Policy
- Login rate limiting / temporary lockout
- Production error display disabled; errors logged to `storage/logs/`

## Important modules

| Module | Path |
|--------|------|
| Bootstrap | `app/bootstrap.php` |
| Config | `app/config/config.php` |
| Auth | `app/core/Auth.php` |
| CSRF | `app/core/Csrf.php` |
| Upload | `app/helpers/Upload.php` |
| Helpers | `app/helpers/functions.php` |
| Admin data layer | `admin/data/*.php` |
| Login | `req/login.php` |

## Routes / pages

Public (extensionless URLs via rewrite): `/`, `/about`, `/notices`, `/news`, `/gallery`, `/routine`, `/contact`, `/login`, `/public_results_jsc`, `/public_results_ssc`, …

Admin: `/admin/`, `/admin/teacher`, `/admin/student`, `/admin/results`, …

Teacher: `/Teacher/classes`, `/Teacher/students`, `/Teacher/teacher-edit`, …

Student: `/Student/grade`, `/Student/pass`

Registrar: `/RegistrarOffice/`, `/RegistrarOffice/student-add`

## Assets

- Legacy: `css/style.css`, `img/`, `logo.png`
- Canonical copies: `assets/css/`, `assets/images/`
- Uploads: `uploads/gallery`, `uploads/teachers`, `uploads/news`, `uploads/notices`, `uploads/governing_body`

## Dependencies

- PHP standard library + PDO
- Bootstrap 5, Font Awesome, jQuery (CDN)
- Optional: PhpSpreadsheet (`vendor/`) for Excel imports

## Deployment steps

1. Set env vars or update `app/config/config.php` (no debug).
2. Import/migrate database.
3. Deploy files over HTTPS.
4. Verify `.htaccess` is active.
5. Set `SMS_APP_URL` to the HTTPS origin.
6. Smoke-test login for all roles, uploads, and a sample CRUD flow.
7. Rotate DB credentials and default admin password.

## Backup procedure

1. Export MySQL: `mysqldump -u USER -p DBNAME > backup-YYYYMMDD.sql`
2. Archive `uploads/` and `app/config/` (without committing secrets to public repos)
3. Store backups off-server; test restore quarterly

## Maintenance guide

- Monitor `storage/logs/php-error.log`
- Keep PHP and MySQL updated
- Review admin users periodically
- Prune unused gallery/news uploads
- After code updates, clear opcode cache if enabled

## Troubleshooting

| Symptom | Check |
|---------|--------|
| Blank page | `SMS_APP_DEBUG=1` temporarily; read `storage/logs/php-error.log` |
| DB error | Credentials / DB imported / PDO MySQL enabled |
| CSRF errors | Forms must include `<?= csrf_field() ?>`; cookies enabled |
| Upload fails | Directory permissions; MIME/extension allowlist; size limits |
| Excel import fails | Install PhpSpreadsheet into `vendor/` |
| Session lost | HTTPS/`secure` cookie mismatch; set `SMS_APP_URL` correctly |
| 403 on assets | `.htaccess` rules; ensure not matching blocked patterns |

## Future improvements

- Full consolidation of duplicated `data/` helpers into `app/models`
- Move document root to a dedicated `public/` directory on VPS hosts
- Add automated PHPUnit / integration tests
- Add CAPTCHA or stronger bot protection on public contact/login
- Implement fine-grained RBAC permissions
- Replace CDN dependencies with local asset builds where required

## License / ownership

Internal school project. Update this section with your organization’s licensing terms as needed.
