# Deploying to Plesk

1. **Create the site.** Websites & Domains → Add Domain. Hosting type: website hosting. Leave the document root as `httpdocs`.
2. **PHP.** Hosting & DNS → PHP: choose PHP 8.1 or newer, "FPM application served by Apache" (so `.htaccess` applies).
3. **Build locally**: `cd site/frontend && npm ci && npm run build`. This writes `site/httpdocs/assets/build/`.
4. **Upload** the contents of `site/` to the subscription root (the folder that contains `httpdocs`), so you end up with:
   ```
   /var/www/vhosts/<domain>/httpdocs/   <- site/httpdocs
   /var/www/vhosts/<domain>/app/        <- site/app
   /var/www/vhosts/<domain>/storage/    <- site/storage (writable by the PHP user)
   ```
   `frontend/` and `scripts/` don't need to go up. With Plesk's Git extension you can deploy from the repo instead and set the deploy path to the subscription root.
5. **SSL.** SSL/TLS Certificates → Let's Encrypt, tick "Redirect from HTTP to HTTPS".
6. **nginx.** If Apache & nginx settings has "Serve static files directly by nginx" on, that's fine; the front controller still gets every page request.
7. **Mail.** The contact form uses PHP `mail()`, which Plesk delivers through its own mail server. Create the mailbox in `config.php → contact_to`, add SPF/DKIM in Mail Settings, and send a test enquiry. If messages land in spam, switch to SMTP.
8. **Check**: `/`, `/sitemap.xml`, `/llms.txt`, `/robots.txt`, a 404, and a test form submission. Submit the sitemap in Google Search Console.
