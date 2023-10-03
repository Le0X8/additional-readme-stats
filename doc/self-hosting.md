# Self hosting

If you want to self host this project, please read the following instructions.

## Requirements

You will get the best experience if you use a Linux server.

- Apache or Nginx
- PHP 8.1
- Composer
- MariaDB or MySQL (MariaDB is recommended)
- PHP mysqli extension
- PHP curl extension

For all the requirements, you can find a lot of installation guides on the internet.

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

## Installation

Simply just clone this repository into your server root and run `composer install` to install all dependencies.

**Important:**
You should visit `<protocol>://<your domain>/public` to create the encryption & decryption keys.

### Keys

You need to specify your own keys.

Just rename `keys-default.php` to `keys.php` and fill in your keys.

#### Database connection

1. Create a new database just for this project
2. Fill in the database credentials in `keys.php`

#### Spotify

1. Create a new Spotify application [here](https://developer.spotify.com/dashboard/create);
2. Set redirect URI to `<protocol>://<your domain>/spotify/callback`;
3. After creating the application, go to settings and copy the client ID and client secret.
4. Fill in the keys in `keys.php`.

**Note:**
If you are in development mode, you have to add yourself and everyone who can use the same credentials as you in the `User Management` tab in your application dashboard.
