# Create a website monitoring tool with Symfony 5

_September 2021_

> 🔨 From udemy: [Symfony : projet complet par la pratique - Florent NICOLAS](https://www.udemy.com/course/monitoring-de-site-web-avec-symfony/).

---

![logo](_readme-img/symfony-logo.png)

## Concepts

### Doctrine ORM

Doctrine ORM is an object-relational mapper (ORM) for PHP 7.1+ that provides transparent persistence for PHP objects. It uses the Data Mapper pattern at the heart, aiming for a complete separation of your domain/business logic from the persistence in a relational database management system.

The benefit of Doctrine for the programmer is the ability to focus on the object-oriented business logic and worry about persistence only as a secondary problem. This doesn't mean persistence is downplayed by Doctrine 2, however it is our belief that there are considerable benefits for object-oriented programming if persistence and entities are kept separated.

**Fixtures** are used to load a "fake" set of data into a database that can then be used for testing or to help give you some interesting data while you're developing your application.

`php bin/console doctrine:fixtures:load`

### PHP entities

Entities are PHP Objects that can be identified over many requests by a unique identifier or primary key. These classes don't need to extend any abstract base class or interface. An entity class must not be final or contain final methods. Additionally it must not implement clone nor wakeup, unless it does so safely.

An entity contains persistable properties. A persistable property is an instance variable of the entity that is saved into and retrieved from the database by Doctrine's data mapping capabilities.

In this app, we have three entities: _Website_, _Admin_ and _Status_.

### PHP Operators

**The double arrow operator =>** (assign)

The arrays are accessed with the use of a double arrow operator. In other terms, the operator is also used to assign a certain value to an acceptable type of operator in the array index which can be in the form of either numeric or string-based (associative). Moreover, double arrow operator => assigns the value to an array key.

**The object operator ->** (access)

The -> operator, also known as the object operator is used to access the properties and methods for a specific object. Besides, in simple words, the object operator -> is responsible for accessing an object method.

**Scope resolution operator ::**

:: is called as scope resolution operator (AKA Paamayim Nekudotayim). This operator is used to refer the scope of some block or program context like classes, objects, namespace and etc. For this reference an identifier is used with this operator to access or reproduce the code inside that scope.

### What is the PHP cURL?

cURL stands for the client URL. PHP cURL is a library that is the most powerful extension of PHP. It allows the user to create the HTTP requests in PHP. cURL library is used to communicate with other servers with the help of a wide range of protocols.

cURL allows the user to send and receive the data through the URL syntax. cURL makes it easy to communicate between different websites and domains.

### Symfony 5: Hash PW using UserPasswordHasherInterface

_DataFixtures/AppFixtures.php_

```php
// ..
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
   public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
      $this->encoder = $passwordHasher;
    }
    public function load(ObjectManager $manager)
    {
      $admin = new Admin();
      $admin->setEmail('xxx.xxx.com')
              ->setPassword('xxx');
      $encoded= $this->encoder->hashPassword($admin, $admin->getPassword());
      $admin->setPassword($encoded);
      $manager->persist($admin );
      //..
    }
// ..
}
```

_Entity/Admin.php_

```php
// ..
    public function setEmail(string $email): self {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(string $password): self {
        $this->password = $password;

        return $this;
    }
//..
```

_config/packages/security.yaml_

```yaml
password_hashers:
  App\Entity\Admin: "auto"
```

`php bin/console doctrine:fixtures:load`

### Secure route admin

_config/packages/security.yaml_

```yaml
access_control:
  - { path: ^/admin/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
  - { path: ^/admin, roles: ROLE_ADMIN }
```

Or

\_Controller/AdminController.php

```php
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
// ...
    /**
     * @Route("/admin", name="admin_dashboard")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(WebsiteRepository $repository)
    {
      // ...
    }
// ...
```

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

#### Import class in VSCODE

- Right click on any class name and select Import Class to automatically import it's namespace at the top of the file.
- Press CTRL + ALT + i on Windows / CTRL + Option + i on MacOS.

#### Create controller + template (views)

`php bin/console make:controller <ControllerName>`

#### Create entity + repository

`php bin/console make:entity`

`<EntityName>`

-- `<PropertyName>`

---- `<FieldName>`

Migration:

`php bin/console make:migration`

If problem try: `sudo apt-get install php-mysql`

`php bin/console doctrine:migration:migrate`

#### Update entity

`php bin/console make:entity <ExistingEntityName>`

-- `<PropertyName>`

---- `<FieldName>`

`php bin/console make:migration`

`php bin/console doctrine:migration:migrate`

#### Create command

`php bin/console make:command`

Ex: `check:status`

Execute with: `php bin/console check:status`

Or add --help for more informations: `php bin/console check:status --help`

_src/command/CheckStatusCommand.php_

### Packages

- [symfony/orm-pack](https://packagist.org/packages/symfony/orm-pack): A pack for the Doctrine ORM.

`sudo composer require symfony/orm-pack`

- [symfony/maker-bundle](https://packagist.org/packages/symfony/maker-bundle): Symfony Maker helps you create empty commands, controllers, form classes, tests and more so you can forget about writing boilerplate code.

`sudo composer require symfony/maker-bundle`

- [twig/twig](https://packagist.org/packages/twig/twig): Twig, the flexible, fast, and secure template language for PHP.

`sudo composer require twig/twig`

- [DoctrineFixturesBundle](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html): Fixtures are used to load a "fake" set of data into a database that can then be used for testing or to help give you some interesting data while you're developing your application.

`sudo composer require --dev doctrine/doctrine-fixtures-bundle`

It creates _./src/DataFixtures_.

Use `php bin/console doctrine:fixtures:load` to flush.

- [Bootstrap 5 Form Theme](https://symfony.com/doc/current/form/bootstrap5.html)

_config/packages/twig.yaml_

```yaml
# config/packages/twig.yaml
twig:
  form_themes: ["bootstrap_5_layout.html.twig"]
```

## Useful links

- [WSL2-Windows Linux Subsystem: A guide to install a Local Web Server Ubuntu-20.04 Apache,PHP8 y MySQL8](https://dev.to/aitorsol/wsl2-windows-linux-subsystem-a-guide-to-install-a-local-web-server-ubuntu-20-04-apache-php8-y-mysql8-3bbk)
- [Symfony CLI](https://symfony.com/download)
- [How to Use PHP’s built-in Web Server](https://symfony.com/doc/4.4/setup/built_in_web_server.html)
- [Getting Started with Doctrine](https://www.doctrine-project.org/projects/doctrine-orm/en/2.9/tutorials/getting-started.html#getting-started-with-doctrine)
- [DDD et MVC: différence entre 'Model' et 'Entity'](https://www.it-swarm-fr.com/fr/php/ddd-et-mvc-difference-entre-model-et-entity/969716076/)
- [Symfony Encore](https://grafikart.fr/tutoriels/encore-symfony-1075)
- [Symfony – Comment mettre en place des Fixtures](https://blog.gary-houbre.fr/developpement/symfony/symfony-comment-mettre-en-place-des-fixtures)
- [Fonctions cURL](https://www.php.net/manual/fr/function.curl-init.php)
- [L'opérateur de résolution de portée (::)](https://tecfa.unige.ch/guides/php/php5_fr/language.oop5.paamayim-nekudotayim.html)
- [PasswordHasher Component](https://symfony.com/blog/new-in-symfony-5-3-passwordhasher-component)
- [Flash Messages](https://www.udemy.com/course/monitoring-de-site-web-avec-symfony/learn/lecture/16932892#questions)
- [Validation Constraints Reference](https://symfony.com/doc/current/reference/constraints.html)
- [Tutoriel Symfony : Héberger le site sur un hébergement mutualisé](https://www.youtube.com/watch?v=AAap9qRHgIk)
