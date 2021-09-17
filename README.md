# Create a website monitoring tool with Symfony 5

_September 2021_

> 🔨 From udemy: [Symfony : projet complet par la pratique - Florent NICOLAS](https://www.udemy.com/course/monitoring-de-site-web-avec-symfony/).

---

![logo](_readme-img/symfony-logo.png)

## Usefull commands

### Create Symfony application:

`cd /`

`cd /var/www/html`

`symfony new --full my_project`

Give the rights to a directory: `sudo chmod -R 777 /var/www/html/my_project`

### Check Symfony and PHP versions

`php bin/console about`

### Upgrade composer

`sudo apt remove composer`

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"
```

`sudo composer -v`

### Symfony Web Server

`symfony server:start`

`symfony open:local` or [http://localhost:8000/](http://localhost:8000/)

### Packages

- [symfony/orm-pack](https://packagist.org/packages/symfony/orm-pack): A pack for the Doctrine ORM.

`sudo composer require symfony/orm-pack`

- [symfony/maker-bundle](https://packagist.org/packages/symfony/maker-bundle): Symfony Maker helps you create empty commands, controllers, form classes, tests and more so you can forget about writing boilerplate code.

`sudo composer require symfony/maker-bundle`

- [twig/twig](https://packagist.org/packages/twig/twig): Twig, the flexible, fast, and secure template language for PHP.

`composer require twig/twig`

### Manage Services:

#### Apache2

```bash
sudo service apache2 start
sudo service apache2 restart
sudo service apache2 stop
sudo service apache2 status
sudo service apache2 -v
```

#### MySQL

```bash
sudo service mysql start
sudo service mysql restart
sudo service mysql stop
sudo service mysql status
sudo service mysql -v
```

#### Create DB

`sudo mysql`

```sql
CREATE USER 'USER_NAME'@'%' IDENTIFIED BY 'PASSWORD';

GRANT ALL PRIVILEGES ON *.* TO 'USER_NAME'@'%' WITH GRANT OPTION;

use mysql;

SELECT User FROM user;

CREATE DATABASE DB_NAME;

Show DATABASES;

```

Or to check if the connexion is done, in terminal:

`mysql -u 'USER_NAME -p`

#### Create controller + template

`php bin/console make:controller <ControllerName>`

## Useful links

- [WSL2-Windows Linux Subsystem: A guide to install a Local Web Server Ubuntu-20.04 Apache,PHP8 y MySQL8](https://dev.to/aitorsol/wsl2-windows-linux-subsystem-a-guide-to-install-a-local-web-server-ubuntu-20-04-apache-php8-y-mysql8-3bbk)
- [Symfony CLI](https://symfony.com/download)
- [How to Use PHP’s built-in Web Server](https://symfony.com/doc/4.4/setup/built_in_web_server.html)
