# yii2-crawler
Advanced web crawler module

# Features

* Multiple connections on single object
* Define and use multiple proxys
* Define and use multiple identities (usarname/password)


# Install

Install using composer:

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist macklus/yii2-geoselect "*"
```

or add

```
"macklus/yii2-geoselect": "*"
```

to the require section of your `composer.json` file.

# Usage

Create new object:

```php
<?php

namespace app\controllers;

use macklus\Crawler\Crawler;

class TestController extends Controller
{
    public function actionCraw()
    {
        $crawler = new Crawler();
    }
}
```

## UserAgent

```php
$crawler->setUA($browser)
/*
 * Browser could be chrome, firefox or explorer
 */
```

## Identities

```php
$crawler->setUser($name, $user, $password)
$crawler->setUsers(['user1' => ['username' => 'jhon', 'password' => 'doe']])
```

## Proxys

```php
$crawler->setProxy($name, $string)
$crawler->setProxys([['proxy1' => 'proxystring', 'proxy2' => 'proxy2string]])
/*
 * string should contain all proxy info, like http://username:password@proxy.thing.com:8080/
 */
```

