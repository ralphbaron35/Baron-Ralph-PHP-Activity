# Pixel World – PHP Includes & Validation Activity

Converted from the HTML lab (`Activity3.html`, `Act3page2.html`, `landing-page.html`) into PHP.

## Structure
```
index.php                 <- main file: ONLY include statements
login.php                 <- was Activity3.html  (PHP + regex validation)
register.php              <- was Act3page2.html  (PHP + regex validation)
includes/
  head.php                <- <head>, CSS links, opening <body>
  navigation.php          <- navbar
  header.php              <- hero section
  main-content.php       <- "About" section
  footer.php              <- footer
  scripts.php             <- JS + closing </body></html>
  validation.php          <- preg_match patterns + validator functions
assets/css, assets/images
screenshots/              <- put code + output screenshots here
```

## Run locally (XAMPP/WAMP)
1. Copy this folder into `C:\xampp\htdocs\` (e.g. `htdocs\Baron_Activity_PHP`).
2. Start **Apache** in the XAMPP Control Panel.
3. Open `http://localhost/Baron_Activity_PHP/index.php`
   (also `/login.php` and `/register.php`).

Internet is needed for the Bootstrap CDN and the login background image.

## Validation rules (preg_match)
| Field | Rule |
|---|---|
| Username | starts with a letter, 3–20 chars, letters/numbers/underscore |
| Email | `name@domain.tld` pattern |
| Phone | 7–15 digits, optional leading `+` (spaces, dashes, parentheses ignored) |
| Password (register) | 7+ chars, at least 1 letter and 1 number, must not contain username |
| Confirm password | must match password |
| Login | username-or-email pattern; password at least 6 chars |

A valid login redirects to `index.php`; a valid registration redirects to `login.php?registered=1`.

## Notes
- `style.css` (landing page) was missing from the original zip, so it was recreated.
- "Chronicle", "Nation", "Resume" and "Projects" links point to `#` because those pages don't exist yet.
