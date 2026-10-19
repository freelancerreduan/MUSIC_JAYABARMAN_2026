# Jaya Barman website (HTML + CSS + Bootstrap 5)

Open `index.html` in a browser, or serve the folder (`python -m http.server`) so the Facebook/YouTube embeds load. No build step.

## Menu
| Menu | File | Content |
|---|---|---|
| Home | `index.html` | Hero, bio, latest highlight, links to every section |
| Project | `project.html` | 2 featured cards (image or video + external link, opens in a new tab), Videos, Photos |
| Performance | `performance.html` | World Music Day 2026 (Paris) + 4 videos with their texts |
| Interview | `interview.html` | Agamir Shomoy and Jugantor Facebook videos |
| News & Views | `news-views.html` | BanglaVision (YouTube) and Channel i (Facebook) |
| Portfolio | `portfolio.html` | Image gallery with filter (waiting for new content) |
| Archive | `archive.html` | Placeholder (waiting for content) |
| Contacts | `contact.html` | Contact details + form (waiting for new content) |

`about.html` is the full CV, linked from Home and the footer.

## Files
- `assets/css/style.css`: all design. Colours are at the top in `:root`.
- `assets/js/main.js`: navbar, video play buttons, lightbox, filter, audio, contact form.
- `assets/video/performance-01.mp4` … `04.mp4`: Performance videos (30–45 MB each; compress before going live for faster loading).

## Things to replace
- Performance video 3 text stops at "...very close to her heart." The original text continued with "Although…"; add the rest in `performance.html` (search for "pending").
- Images in `assets/img/` are low resolution. Replace with original photos using the same file names.
- Social links in the footer are `#`; replace with real URLs (WhatsApp already works).
