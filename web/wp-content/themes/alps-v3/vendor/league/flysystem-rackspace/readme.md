# Flysystem Adapter for Rackspace.

[![Author](http://img.shields.io/badge/author-@frankdejonge-blue.svg?style=flat-square)](https://twitter.com/frankdejonge)
[![Build Status](https://img.shields.io/travis/thephpleague/flysystem-rackspace/master.svg?style=flat-square)](https://travis-ci.org/thephpleague/flysystem-rackspace)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/thephpleague/flysystem-rackspace.svg?style=flat-square)](https://scrutinizer-ci.com/g/thephpleague/flysystem-rackspace/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/thephpleague/flysystem-rackspace.svg?style=flat-square)](https://scrutinizer-ci.com/g/thephpleague/flysystem-rackspace)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/league/flysystem-rackspace.svg?style=flat-square)](https://packagist.org/packages/league/flysystem-rackspace)
[![Total Downloads](https://img.shields.io/packagist/dt/league/flysystem-rackspace.svg?style=flat-square)](https://packagist.org/packages/league/flysystem-rackspace)


## Installation

```bash
composer require league/flysystem-rackspace
```

## Usage

```php
use OpenCloud\OpenStack;
use OpenCloud\Rackspace;
use League\Flysystem\Filesystem;
use League\Flysystem\Rackspace\RackspaceAdapter as Adapter;

$client = new Rackspace(Rackspace::UK_IDENTITY_ENDPOINT, array(
    'username' => ':username',
    'apiKey' => ':password',
));

$store = $client->objectStoreService('cloudFiles', 'LON');
$container = $store->getContainer('flysystem');

$filesystem = new Filesystem(new Adapter($container));
```
