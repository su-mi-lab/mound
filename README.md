# mound

[![Build Status](https://travis-ci.org/su-mi-lab/mound.svg?branch=master)](https://travis-ci.org/su-mi-lab/mound)
[![MIT License](http://img.shields.io/badge/license-MIT-blue.svg?style=flat)](LICENSE)
[![Total Downloads](https://poser.pugx.org/bank/mound/downloads)](https://packagist.org/packages/mound/mound-db)
[![Code Climate](https://codeclimate.com/github/su-mi-lab/mound/badges/gpa.svg)](https://codeclimate.com/github/su-mi-lab/mound)

Validator

## Installation

Add this to your composer.json file, in the require object:

```php
"bank/mound": "version"
```

Alternately, clone the gatewaysitory and manually invoke `composer` using the shipped

```php
php composer.phar self-update
php composer.phar install
```

## Converter


```php

$provider = new \Mound\Converter\Provider;

$data = [
    'test_data1' => ' test_data1',
    'test_data2' => 'test_data2 ',
    'test_data3' => '　test_data3　'
];

$provider
    ->rule('test_data1')
    ->attach(\Mound\Converter\Rules\Trim::class)
    ->rule('test_data2')
    ->attach(\Mound\Converter\Rules\Trim::class)
    ->rule('test_data3')
    ->attach(\Mound\Converter\Rules\Trim::class);

$data = $provider->exec($data);

#$data = [
#    'test_data1' => 'test_data1',
#    'test_data2' => 'test_data2',
#    'test_data3' => 'test_data3'
#];

```

### Converter Rules
* Trim

## Filter

```php

$provider = new \Mound\Filter\Provider;

$data = [
    'test_data1' => '',
    'test_data2' => 'test_data2',
    'test_data3' => 'test'
];
$provider
    ->rule('test_data1')
    ->attach(\Mound\Filter\Rules\NotEmpty::class)
    ->rule('test_data2')
    ->attach(\Mound\Filter\Rules\NotEmpty::class)
    ->rule('test_data3')
    ->attach(\Mound\Filter\Rules\NotEmpty::class);

$data = $provider->exec($data);

#$data = [
#    'test_data2' => 'test_data2'
#];

```

### Filter Rules
* NotEmpty
* Number

## Validator

```php

$provider = new \Mound\Validator\Provider;
$data = [
    'test_data1' => '',
    'test_data2' => 'test_data2',
    'test_data3' => ''
];
$provider
    ->rule('test_data1')
    ->attach(\Mound\Validator\Rules\NotEmpty
    ->rule('test_data2')
    ->attach(\Mound\Validator\Rules\NotEmpty
    ->rule('test_data3')
    ->attach(\Mound\Validator\Rules\NotEmpty
$error = $provider->exec($data);

#$error = [
#    'test_data1' => 'can't be blank',
#    'test_data2' => 'can't be blank',
#];

```

### Validator Rules
* NotEmpty
