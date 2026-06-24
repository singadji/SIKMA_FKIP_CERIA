# Troubleshooting: 403 Forbidden Error

## Common Causes & Solutions

### 🔍 Diagnosis Steps

#### 1. Check if Web Server is Running
```bash
# Check if Apache is running (on macOS)
sudo lsof -i :80
# or
ps aux | grep apache

# On Linux
sudo systemctl status apache2
```

#### 2. Check Virtual Host Configuration
Ensure your virtual host includes:
```apache
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot /Users/marcellosingadji/Public/HTDOCS/SIKMA_FKIP_CERIA/public
    
    <Directory /Users/marcellosingadji/Public/HTDOCS/SIKMA_FKIP_CERIA/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### 3. Verify Apache Modules are Enabled
```bash
# macOS - Check if modules are loaded
apache2ctl -M | grep -E "rewrite|headers|expires|deflate"

# Should output:
# rewrite_module (shared)
# headers_module (shared)
# expires_module (shared)
# deflate_module (shared)
```

If modules are missing, enable them:
```bash
# On macOS with Homebrew Apache
brew services restart httpd

# On Linux
sudo a2enmod rewrite headers expires deflate
sudo systemctl restart apache2
```

### ❌ Common Error Scenarios

#### Error: "Forbidden - You don't have permission to access this resource."

**Cause 1: AllowOverride not set in Virtual Host**
- Solution: Add `AllowOverride All` to your VirtualHost directive

**Cause 2: Directory permissions too restrictive**
```bash
# Fix permissions
chmod -R 755 /Users/marcellosingadji/Public/HTDOCS/SIKMA_FKIP_CERIA/public
chmod 644 /Users/marcellosingadji/Public/HTDOCS/SIKMA_FKIP_CERIA/public/.htaccess
```

**Cause 3: Apache user cannot read files**
```bash
# Change ownership to Apache user (macOS uses _www)
sudo chown -R _www:_www /Users/marcellosingadji/Public/HTDOCS/SIKMA_FKIP_CERIA/public

# Or use 'nobody' or 'www-data' on Linux
sudo chown -R www-data:www-data /var/www/SIKMA_FKIP_CERIA/public
```

**Cause 4: .htaccess syntax error**
- Check `.htaccess` for malformed rules
- Test individual rules by commenting them out
- Verify using: `apache2ctl configtest` or `httpd -t`

**Cause 5: CSP Header too restrictive**
- The previous CSP header may have blocked resources
- Current .htaccess uses safer headers
- If issues persist, temporarily disable:
  ```apache
  # Comment out this section temporarily
  # <IfModule mod_headers.c>
  #     Header always set ...
  # </IfModule>
  ```

### ✅ Verification Checklist

- [ ] Apache is running: `ps aux | grep apache`
- [ ] Modules are loaded: `apache2ctl -M | grep rewrite`
- [ ] Virtual host configured correctly
- [ ] Directory permissions: `755` for dirs, `644` for files
- [ ] Apache user can read files: check with `sudo -u _www ls -la`
- [ ] .htaccess syntax is valid
- [ ] AllowOverride All in virtual host
- [ ] No typos in .htaccess file paths

### 🔧 Quick Test

Create a simple test file:
```bash
echo "<?php phpinfo(); ?>" > /Users/marcellosingadji/Public/HTDOCS/SIKMA_FKIP_CERIA/public/test.php
```

Then visit: `http://localhost/SIKMA_FKIP_CERIA/public/test.php`

If this works, the .htaccess rules are working. If it gives 403, check:
- Virtual host setup
- Apache modules
- Directory permissions

### 📋 Virtual Host Example (macOS with Homebrew)

Edit `/usr/local/etc/httpd/httpd.conf`:

```apache
Include /usr/local/etc/httpd/extra/httpd-vhosts.conf
```

Edit `/usr/local/etc/httpd/extra/httpd-vhosts.conf`:

```apache
<VirtualHost *:80>
    ServerName localhost
    ServerAlias *.local
    DocumentRoot /Users/marcellosingadji/Public/HTDOCS
</VirtualHost>

<VirtualHost *:80>
    ServerName sikma.local
    DocumentRoot /Users/marcellosingadji/Public/HTDOCS/SIKMA_FKIP_CERIA/public
    
    <Directory /Users/marcellosingadji/Public/HTDOCS/SIKMA_FKIP_CERIA/public>
        AllowOverride All
        Require all granted
        
        <IfModule mod_rewrite.c>
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteRule ^ index.php [L]
        </IfModule>
    </Directory>
</VirtualHost>
```

### 🚀 Laravel Artisan Troubleshooting

If using Laravel artisan serve instead of Apache:
```bash
cd /Users/marcellosingadji/Public/HTDOCS/SIKMA_FKIP_CERIA
php artisan serve --host=localhost --port=8000
```

Then access: `http://localhost:8000/`

### 📝 Apache Log Analysis

Check Apache error logs:

**macOS (Homebrew):**
```bash
tail -f /usr/local/var/log/httpd/error_log
```

**macOS (System):**
```bash
tail -f /var/log/apache2/error_log
```

**Linux:**
```bash
sudo tail -f /var/log/apache2/error.log
```

Look for specific errors related to:
- Rewrite rules
- Module loading
- Directory access

---

## 📞 Quick Support

**Still seeing 403?**
1. Check Apache error logs (see above)
2. Run: `apache2ctl configtest` or `httpd -t`
3. Verify file permissions: `ls -la public/`
4. Test with `php artisan serve` instead of Apache
5. Check virtual host configuration

**Need more help?**
- [Apache Virtual Hosts Docs](https://httpd.apache.org/docs/2.4/vhosts/)
- [Laravel Installation Docs](https://laravel.com/docs/installation)
- [htaccess Guide](https://httpd.apache.org/docs/current/howto/htaccess.html)

---
**Updated**: 2026-06-25
