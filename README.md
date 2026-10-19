# Jaya Barman website — Laravel

The static HTML site converted to Laravel 12, with an admin panel to manage every page.
The original HTML files are kept in `old-html-site/` (not used by Laravel).

- **Website**: same design as before (Bootstrap 5, `public/assets/css/style.css`), now built from the database.
- **Admin panel**: `/admin` — a simple dashboard that lists every website page and what you can edit on it, plus the contact-form messages. Light and dark theme.

## Run it

**Easiest:** double-click **`run-website.bat`**. It:

1. starts Laragon's MySQL if it is not running,
2. installs packages and creates `.env` on the first run,
3. creates the `jaya_barman` database, runs migrations and fills in the content (`php artisan site:setup` — safe to run every time, your edits are kept),
4. opens http://127.0.0.1:8000/admin in the browser and runs the site. Close the window to stop it.

**By hand** (in this folder, with MySQL running):

```bash
php artisan site:setup
php artisan serve
```

Website: http://127.0.0.1:8000 — Admin: http://127.0.0.1:8000/admin

Database: `jaya_barman` on `127.0.0.1:3306`, user `root`, no password (Laragon default). Change it in `.env`.

### Admin login

`php artisan db:seed` creates the admin user from `ADMIN_EMAIL` / `ADMIN_PASSWORD` in `.env` (see `.env.example` for the defaults). **Change the password** from the user menu (top right) → *Login & password* after the first sign-in, and set your own values in `.env` before seeding a live server.

## Admin menu = website menu

The sidebar's **Website sections** use the same names and order as the site's navbar, so you always know where to edit:

| Website menu | What you can edit there |
|---|---|
| Home | Top banner, About the artist text & photo, Latest concert box |
| Project | Top banner, Big image cards, Videos, Photos |
| Performance | Top banner, Concert details, Performance videos |
| Interview | Top banner, Interview videos |
| News & Views | Top banner, News & TV videos |
| Portfolio | Top banner, Portfolio photos |
| Archive | Top banner, Archive items |
| About | Top banner, Personal details & photo, Current status, CV boxes |
| Contacts | Top banner, Phone, email & social links, Messages |

Every edit screen shows a bar like *Website › Project › Videos* with a **View Project page** button.
Long texts are plain paragraphs (an empty line between them); `**word**` = bold, `*word*` = italic, `[name](https://link)` = link. Bangla text gets the Bangla font automatically. New items are added at the end of their list.

## Images (Intervention Image)

Uploaded images go through [Intervention Image](https://image.intervention.io) (`app/Support/ImageService.php`): phone photos are rotated correctly, shrunk to max 1920 px, saved as WebP, and a 640 px `-thumb` copy is made for galleries and admin lists. Replacing or deleting an image also removes the old files. Images under `public/assets/` (the original site's) are never deleted.
## Files

- `app/Http/Controllers/SiteController.php` — public pages and contact form
- `app/Http/Controllers/Admin/*` — admin panel
- `resources/views/site/*`, `layouts/site.blade.php` — website templates
- `resources/views/admin/*`, `layouts/admin.blade.php` — admin templates
- `public/admin-assets/admin.css` — admin design (colours at the top in `:root`)
- `database/seeders/*` — all content from the original HTML site
- Uploads are saved in `public/uploads/` (no `storage:link` needed).
- `app/Support/AdminMenu.php` — the admin sidebar (website sections)
- `run-website.bat` — one-click start

## Notes

- Large videos: PHP upload limits come from `php.ini` (`upload_max_filesize`, `post_max_size`). For big files you can also copy the MP4 into `public/assets/video/` and type its path in the video form.
- Performance video 3 text still ends at “…very close to her heart.” — finish it in *Performance → Performance videos → Bengali Folk on Ranga Shokal*.
