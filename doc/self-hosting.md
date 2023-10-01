# Self hosting

If you want to self host this project, please read the following instructions.

## Requirements

- Apache or Nginx
- PHP 8.1

### Additional configuration

#### Apache

Configure your Apache server to rewrite all requests to allow `.htaccess` files.

#### Nginx

Open your configuration file and change the following line:

```nginx
location / {
    try_files $uri $uri/ =404;
}
```

to

```nginx
location / {
    try_files $uri $uri/ /index.php;
}
```
