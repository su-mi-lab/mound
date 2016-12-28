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


## Provider
* Converter Provider
* Filter Provider
* Validator Provider

### Use Provider

Interface

`public function rule(string $key): ProviderInterface;`

`public function group(string $key): ProviderInterface`

`public function attach($rule, array $options = []): ProviderInterface`

`public function exec(array $data, array $groups): array`


Attach rule

```php
$provider
  ->rule($key_name)
  ->attach(Rules::class, $options)
  ->attach(Rules::class, $options)
```

Group rules

```php
$provider
  ->group($group_name)
  ->rule($key_name)
  ->attach(Rules::class, $options)
  ->attach(Rules::class, $options)
```

Execution

```
$provider->exec($data, $group_names);
```


### Converter Provider

Convert parameters according to rules.

Returned value is converted data.

The rules that can be used are class that extends AbstractConverter.

#### Example

```php

use Mound\Converter;

$provider = new Converter\Provider;

$data = ['test_data1' => ' test_data1'];

$provider
  ->rule('test_data1')
    ->attach(Converter\Rules\Trim::class)
  ->endRule

$data = $provider->exec($data);
# ['test_data1' => 'test_data1']
```

#### Converter Rules
* Trim
* Callback

### Filter Provider

Filter parameters according to rules.

Returned value is Filtering data.

The rules that can be used are class that extends AbstractFilter.

#### Example

```php
use Mound\Filter;

$provider = new Filter\Provider;

$data = ['test_data1' => ' test_data1'];

$provider
  ->rule('test_data1')
    ->attach(Filter\Rules\NotEmpty::class)
  ->endRule

$data = $provider->exec($data);
# []
```

#### Filter Rules
* NotEmpty
* Number
* Callback

### Validator Provider

Validate parameters according to rules.

Returned value is error message.

The rules that can be used are class that extends AbstractValidator.

#### Example

```php
use Mound\Validator;

$provider = new Validator\Provider;

$haystack = ['test_data'];
$data = [
  'test_data1' => 'test_data1'
  'test_data2' => ''
];

$provider
  ->rule('test_data1')->attach(Validator\Rules\NotEmpty::class)
  ->rule('test_data2')->attach(Validator\Rules\NotEmpty::class)
  ->group('in_array')->rule('test_data1')
    ->attach(Validator\Rules\InArray::class, [
      'haystack' => $haystack
    ])
  ->endGroup

$error = $provider->exec($data);
#['test_data2' => 'can't be blank']

$error = $provider->exec($data, ['in_array']);
#['test_data1' => 'is invalid', 'test_data2' => 'can't be blank']
```


#### Validator Rules
* NotEmpty
* InArray
* Callback
